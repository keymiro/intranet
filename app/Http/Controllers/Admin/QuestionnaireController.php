<?php

namespace App\Http\Controllers\Admin;
use App\Questionnaire;
use App\Question;
use App\CorrectOption;
use App\ResultQuestionnaire;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ResultQuestionnaireExport;


class QuestionnaireController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:questionnaire_index')
            ->only('index');
        $this->middleware('permission:questionnaire_create')
            ->only('store');
        $this->middleware('permission:questionnaire_edit')
            ->only('edit','update');
        $this->middleware('permission:questionnaire_destroy')
            ->only('destroy');
        $this->middleware('permission:questionnaire_result_index')
            ->only('ListQuestionnaire','listresultfind','ResultFindPeoples',
            'DetailsResultFindPeoples','ExportQuestionnaire');
    }
    public function index()
    {
        $userid = auth()->user()->id;
        $questionnaires = Questionnaire::latest()
            ->where('user_id', $userid)->paginate(5);
        return view('admin.questionnaire.index',
            compact('questionnaires'));
    }

    public function store(Request $request)
    {
        Questionnaire::create([
            'name'=>$request['name'],
            'try'=>$request['try'],
            'time'=>$request['time'],
            'user_id'=>auth()->user()->id,

        ]);
        /*cuenta el total de preguntas y almacena ese conteo*/
        /*$QueryIdQ=Questionnaire::select('id')->latest('id')->first();
        $countQ= Question::select('questionnaire_id')
        ->where('questionnaire_id',$QueryIdQ->id)
        ->count();
        Questionnaire::where('id',$QueryIdQ->id)
            ->update([
                'count_questions'=>$countQ,
            ]);*/
        return back();
    }



    public function edit($id)
    {
        $questionnaire = Questionnaire::findOrFail($id);
        return view('admin.questionnaire.edit',
        compact('questionnaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $questionnaire = Questionnaire::findOrFail($id);
      $iduser = auth()->user()->id;

      $questionnaire -> update
      ([
           'name'=>$request['name'],
           'try'=>$request['try'],
           'time'=>$request['time'],
           'active'=>$request['active'],
           'user_id'=>$iduser,
       ]);

       return redirect()->route('questionario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      Questionnaire::destroy($id);

        return redirect()->route('questionario.index');

    }
    public function ListQuestionnaire()
    {
        $result = ResultQuestionnaire::select('resultquestionnaires.questionnaire_id',
            'questionnaires.name')
            ->distinct('questionnaires.name')
            ->join('questionnaires', 'resultquestionnaires.questionnaire_id','=','questionnaires.id')
            ->distinct('questionnaires.name')
            ->where('questionnaires.user_id',auth()->user()->id)
            ->latest('resultquestionnaires.id')
            ->paginate(5);
        return view('admin.questionnaire.list_questionnaire',
            compact('result'));
    }

    public function listresultfind($id)
    {
        $user_id =auth()->user()->id;
        $result = ResultQuestionnaire::select('resultquestionnaires.questionnaire_id',
            'resultquestionnaires.user_id','resultquestionnaires.questionnaire_id')
            ->distinct('resultquestionnaires.questionnaire_id')
            ->join('questionnaires', 'resultquestionnaires.questionnaire_id','=','questionnaires.id')
            ->where('questionnaires.user_id',$user_id)
            ->where('resultquestionnaires.questionnaire_id',$id)
            ->distinct('resultquestionnaires.questionnaire_id')
            ->latest('resultquestionnaires.id')
            ->paginate(5);

        return view('admin.questionnaire.result',
            compact('result'));
    }
    public function ResultFindPeoples($questionnaire_id,$user_id)
    {
        $questionnaireId=$questionnaire_id;
        $userId=$user_id;
        $resultPeoplesQ=ResultQuestionnaire::select('resultquestionnaires.repetition_id',
            'resultquestionnaires.questionnaire_id','resultquestionnaires.user_id',
            'resultquestionnaires.score','resultquestionnaires.pass')
            ->distinct('repetition_id')
            ->join('questionnaires', 'resultquestionnaires.questionnaire_id','=','questionnaires.id')
            ->join('users','users.id','=','resultquestionnaires.user_id')
            ->join('peoples','peoples.id','=','users.people_id')
            ->whereNotNull('resultquestionnaires.score')
            ->where('resultquestionnaires.user_id',$userId)
            ->where('resultquestionnaires.questionnaire_id',$questionnaireId)
            ->latest('resultquestionnaires.created_at')
            ->paginate(5);

        return view('admin.questionnaire.result_questionnaire_peoples',
               compact('resultPeoplesQ'));

    }

    public function DetailsResultFindPeoples($questionnaire_id,$user_id,$repetition_id)
    {
        $repetitionId = $repetition_id;
        $questionnaireId=$questionnaire_id;
        $userId=$user_id;
        $people=ResultQuestionnaire::select('*',
            DB::raw('(case pass
                    when "1"
                    then "Aprobo"
                    else "No Aprobo"
                    end)
                    AS  Aprobo'))
            ->where('questionnaire_id',$questionnaireId)
            ->where('repetition_id',$repetitionId)
            ->whereNotNull('score')
            ->where('user_id',$userId)
            ->get();
        $ResultUser=DB::table('resultquestionnaires AS rq')
            ->selectRaw('
                    rq.id AS id,
                    rq.score as Puntaje,
                    qnn.name  AS Cuestionario,
                    qs.statement AS Preguntas,
                    qs.option_a AS Opción_A,
                    qs.option_b AS Opción_B,
                    qs.option_c AS Opción_C,
                    qs.option_d AS Opción_D,
                    (case rq.pass
                    when "1" then "Aprobo"
                    else "No Aprobo" end)  AS  Aprobo,
                    (case rq.correctoption_id
                         when "1"
                             then "A"
                             when "2"
                             then "B"
                             when "3"
                             then "C"
                             when "4"
                             then "D"
                         end) AS RespuestaSeleccionada,co.option AS RespuestaCorrecta,
                    (case rq.correctoption_id
                         when qs.correctoption_id
                            then "✓"
                         else "X"
                         end) AS Correctas,
                    p.names AS Nombres,
                    p.lastnames AS Apellidos,
                    p.document AS Documento,
                    p.phone AS Cel,
                    usr.email AS Correo
            ')->distinct('rq.questionnaire_id','p.names')
            ->join('questionnaires AS qnn', 'qnn.id', '=', 'rq.questionnaire_id')
            ->join('questions AS qs', 'qs.id', '=', 'rq.question_id')
            ->join('users AS usr', 'usr.id', '=', 'rq.user_id')
            ->join('correctoptions AS co', 'co.id', '=', 'qs.correctoption_id')
            ->join('peoples AS p', 'p.id', '=', 'usr.people_id')
            ->join('repetitions AS r', 'r.id', '=', 'rq.repetition_id')
            ->where('rq.questionnaire_id',$questionnaireId)
            ->where('rq.repetition_id',$repetitionId)
            ->where('rq.user_id',$userId)
            ->orderBy('rq.id')
            ->get();

    return view('admin.questionnaire.result_details_questionnaire_peoples',
     compact('ResultUser','people'));
    }
 public function ExportQuestionnaire()
 {
     return (new ResultQuestionnaireExport)
         ->download('Result_questionnaires.xlsx');
 }

}
