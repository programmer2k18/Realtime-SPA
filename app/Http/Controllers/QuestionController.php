<?php

namespace App\Http\Controllers;

use App\Http\Resources\Question\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::getAllQuestions();
        return $questions?  response(QuestionResource::collection($questions),200):
                            response(['msg'=>'No Available Questions yet.'],204);
    }

    /**
     * Store a newly created question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateQuestionInputs($request);
        if ($validator->fails())
            return response(['msg'=>'Not complete or invalid parameters',
                             'errors'=>$validator->errors()],206);

        $data = Question::storeQuestion($validator->validated());
        return response($data,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return response(new QuestionResource($question),200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $validator = $this->validateQuestionInputs($request);
        if ($validator->fails())
            return response(['msg'=>'Not complete or invalid parameters',
                'errors'=>$validator->errors()],206);

        $data = array_merge($validator->validated(),['slug'=>Str::slug($request->title)]);
        $question->update($data);
        return response( new QuestionResource($question),200);
    }

    /**
     * Remove a specific question from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
       return $question->delete()?
           response(['msg'=>'Question deleted successfully'],200):
           response(['msg'=>'Something went wrong, Couldn\'t delete this question'],404);
    }

    public function validateQuestionInputs(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|numeric'
        ]);
        return $validator;
    }
}
