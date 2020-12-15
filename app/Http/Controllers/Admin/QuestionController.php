<?php

namespace App\Http\Controllers\Admin;
use App\Question;
use App\CorrectOption;
use App\Http\Controllers\Controller;
use App\Questionnaire;
use Illuminate\Http\Request;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:question_index')
            ->only('show');
        $this->middleware('permission:question_create')
            ->only('store','create');
        $this->middleware('permission:question_edit')
            ->only('edit','update');
        $this->middleware('permission:question_destroy')
            ->only('destroy');
    }

    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $questionnaire = Questionnaire::all();
       return view('admin.questionnaire.questions.show',
           compact('questionnaire'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Question::create([

            'statement'=>$request['statement'],
            'option_a'=>$request['option_a'],
            'option_b'=>$request['option_b'],
            'option_c'=>$request['option_c'],
            'option_d'=>$request['option_d'],
            'correctoption_id'=>$request['correctoption'],
            'questionnaire_id'=>$request['idquestionnaire'],

        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $correoptions = CorrectOption::all();
       $questionnaire = Questionnaire::where
       ('user_id',auth()->user()->id)
       ->latest()->findOrFail($id);
       $questions = Question::select('questions.id'
        ,'questions.correctoption_id', 'questions.statement','questions.option_a'
        ,'questions.option_b','questions.option_c','questions.option_d','questions.created_at')
        ->join('questionnaires','questionnaires.id', '=', 'questions.questionnaire_id')
        ->join('correctoptions','questions.correctoption_id','=','correctoptions.id')
        ->where('questionnaire_id',$id)
        ->where('questionnaires.user_id',auth()->user()->id)
        ->orderBy('questions.created_at' ,'DESC')
        ->paginate(10);

        return view('admin.questionnaire.questions.show',
        compact('questions','questionnaire','correoptions'));
         }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $correctoptions = CorrectOption::all();
        $questions = Question::find($id);

        return view('admin.questionnaire.questions.edit',
        compact('questions','correctoptions'));
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

     $questions = Question::find($id);

     $questions -> update
     ([
            'statement'=>$request['statement'],
            'option_a'=>$request['option_a'],
            'option_b'=>$request['option_b'],
            'option_c'=>$request['option_c'],
            'option_d'=>$request['option_d'],
            'correctoption_id'=>$request['correctoption'],
        ]);
     return back()->with('notification','Pregunta actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       Question::destroy($id);
        return back();
    }
}
