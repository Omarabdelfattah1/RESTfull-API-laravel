<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Http\Resources\Question as QuestionResource;
use Validator;
class QuestionsController extends Controller
{
    public function index()
    {
        return response()->json(Question::get(),200);
    }

    public function show($id)
    {
        $Question=Question::find($id);
        if (is_null($Question)) {
            return response()->json(null,404);
        }
        $response=new QuestionResource($Question);
        return response()->json($response,200);
    }

    public function store(Request $request)
    {
        $rules=[
            'title'=>'required|max:225',
            'question'=>'required',
            'poll_id'=>'required'
        ];
        $Validator=Validator::make($request->all(),$rules);
        if ($Validator->fails()) {
            return response()->json($Validator->errors(),400);
        }
        $Question=Question::create($request->all());
        return response()->json($Question,201);
    }

    public function update(Question $Question,Request $request)
    {
        $Question->update($request->all());
        return response()->json($Question,200);
    }

    public function destroy(Question $Question)
    {
        $Question->delete();
        return response()->json(["Deleted"],204);
    }
}
