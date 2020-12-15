<?php

namespace App\Http\Controllers;
use App\CorrectOption;
use App\Questionnaire;
use App\Question;
use App\Repetition;
use App\ResultQuestionnaire;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresentQuestionnaireController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:questionnaire_present_index')
             ->only('index');
        $this->middleware('permission:questionnaire_present_result')
            ->only('result');
        $this->middleware('permission:questionnaire_present_show')
            ->only('show');
        $this->middleware('permission:questionnaire_present_create')
            ->only('store');
        $this->middleware('permission:questionnaire_present_result_details')
            ->only('ResultDetailsQuestionnaire');


    }
    public function index()
    {

   $questionnaires = Questionnaire::
       where('active','1')
       ->latest()
       ->paginate(5);
        return view('forms.questionnaire.index',
            compact('questionnaires'));

    }


    public function store(Request $request)
    {
        /* VALIDAD NÚMERO DE INTENTOS */
        $try = Repetition::join('questionnaires','questionnaires.id','=','repetitions.questionnaire_id')
            ->where('repetitions.questionnaire_id',$request['questionnaire_id'])
            ->where('repetitions.user_id', auth()->user()->id)
            ->where('questionnaires.active','1')
            ->count('quantity');
        $questionnaires = Questionnaire::where('active','1')
            ->where('id',$request['questionnaire_id'])
            ->latest()->paginate(5);
                foreach ($questionnaires as $q)
                {
                    $qtry =$q->try;
                }
 if ($try < $qtry)
 {
        $num=1;
        $idquestionnaire= $request['questionnaire_id'];
        $repetition=  Repetition::create([
            'quantity'=>$num,
            'questionnaire_id'=>$idquestionnaire,
            'user_id'=>auth()->user()->id,
        ]);
     if (count($request->question_id) > 0)
    {
        $score=0;
        foreach ($request->question_id as $item=>$v)
        {
            $data=array
            (
                'questionnaire_id'=>$request['questionnaire_id'],
                'user_id'=>auth()->user()->id,
                'question_id'=>$request->question_id[$item],
                'correctoption_id'=>$request->correctoption_id[$item],
                'repetition_id'=>$repetition->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            );

           $scorevalidate=$this->score($request['questionnaire_id'],$request->question_id[$item]);
           $correcoption= (int)$request->correctoption_id[$item];
              if ($scorevalidate[0]->correctoption_id ==$correcoption)
              {
                  $score=$score+1;
              }

             ResultQuestionnaire::insert($data);

        }/* obtiene el id del ultimo cuestionario realizado */
        $save_result =ResultQuestionnaire::select('id','score')->latest('id')->first();
        /*actualiza el campo score con el puntaje obtenido*/
        $id_questionnario_save= $save_result->id;
        ResultQuestionnaire::where('id',$id_questionnario_save)
            ->update([
                'score'=>$score,
            ]);

        /*actualiza el campo pass, 1)aprobo  0)Noaprobo) el cuestionario */

        $pass_resul=ResultQuestionnaire::select('repetition_id')
            ->latest('id')
            ->first();
        $resul_questionnaire_id=$pass_resul->repetition_id;
        $total=ResultQuestionnaire::where('repetition_id',$resul_questionnaire_id)
            ->count('questionnaire_id'); /*cuenta todas las ´reguntas*/

        $scorequery=ResultQuestionnaire::select('repetition_id','score')
         ->where('repetition_id',$resul_questionnaire_id)
         ->whereNotNull('score')->get();
        $prom=$total/2;
        $pass='0';

        if ($scorequery[0]->score>$prom)
        { $pass='1';}else{$pass='0';}
        ResultQuestionnaire::where('id',$id_questionnario_save)
            ->update([
                'pass'=>$pass,
            ]);
        return redirect()->route('presentarq.index');
        }
     }else{
         return   redirect()->route('presentarq.index')
             ->with('notification','Excedió el número de intentos permitidos');
     }

    }
    /**
     * valida la repuesta elegida con la correcta
     *
     */
    public function score($id_questionnaire, $id_question)
    {
        $query =  Question::select('questionnaire_id','correctoption_id','id')
            ->where('questionnaire_id',$id_questionnaire)
            ->where('id',$id_question)->get();
        return $query;

    }
    /**
     * muestra el cuestionario
     *
     */
    public function show($id)
    {
        $try = Repetition::join('questionnaires','questionnaires.id','=','repetitions.questionnaire_id')
            ->where('repetitions.questionnaire_id',$id)
            ->where('repetitions.user_id', auth()->user()->id)
            ->where('questionnaires.active','1')
            ->count('quantity');
        $questionnaires = Questionnaire::where('active','1')
            ->where('id',$id)
            ->latest()->paginate(5);
        foreach ($questionnaires as $q)
        {
            $qtry =$q->try;
        }
            if ($try < $qtry){
                $correoptions= CorrectOption::all();
                $questionnaire = Questionnaire::findOrFail($id);

                $questions = Question::select('questions.id', 'questions.statement','questions.option_a'
                    ,'questions.option_b','questions.option_c','questions.option_d','questionnaires.name')
                    ->join('questionnaires','questionnaires.id', '=', 'questions.questionnaire_id')
                    ->join('correctoptions','questions.correctoption_id','=','correctoptions.id')
                    ->where('questionnaire_id',$id)->get();
                return view('forms.questionnaire.show',
                    compact('questionnaire','questions','correoptions'));
            }else{
                return   redirect()->route('presentarq.index')
                    ->with('error','Excedió el número de intentos permitidos');
            }
    }

    /**
     * muestra el resultado del cuestionario
     *
     */

    public function result()
    {
      $user_id =auth()->user()->id;
      $result = ResultQuestionnaire::
      select(DB::raw('DATE_FORMAT(resultquestionnaires.created_at,"%Y-%m-%d")as created_at'),
          'resultquestionnaires.questionnaire_id','resultquestionnaires.user_id'
          ,'resultquestionnaires.score','resultquestionnaires.repetition_id','repetitions.created_at')
          ->join('repetitions','repetitions.id', '=', 'resultquestionnaires.repetition_id')
          ->distinct('resultquestionnaires.questionnaire_id')
          ->whereNotNull('resultquestionnaires.score')
          ->where('resultquestionnaires.user_id',$user_id)
          ->latest('resultquestionnaires.created_at')
          ->SimplePaginate(5);

      return view('forms.questionnaire.result',
          compact('result'));
    }
    /**
     * muestra el resultado detallado del cuestionario
     *
     */
    public function ResultDetailsQuestionnaire($idquestionnaire,$idrepetition)
    {
        Questionnaire::findOrFail($idquestionnaire);
        $user_id =auth()->user()->id;
        $result = ResultQuestionnaire::
        select('questionnaire_id','user_id','score','repetition_id','pass')
            ->distinct('questionnaire_id')
            ->whereNotNull('score')
            ->where('repetition_id',$idrepetition)
            ->where('user_id',$user_id)
            ->get();

        $total=ResultQuestionnaire:: where('repetition_id',$idrepetition)
            ->count('questionnaire_id');
       $prom=$total/2;

        return view('forms.questionnaire.result_details_questionnaire',
            compact('total','result','prom'));
    }
}
