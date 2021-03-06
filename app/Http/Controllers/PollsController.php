<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\Http\Resources\Poll as PollResource;
use Validator;
class PollsController extends Controller
{
    public function index()
    {
    	return response()->json(Poll::paginate(1),200);
    }

    public function show($id)
    {
    	
    	$poll=Poll::with('questions')->findOrFail($id);
    	//$response=new PollResource($poll);
    	$response['poll']=$poll;
    	$response['questions']=$poll->questions;

    	return response()->json($response,200);
    }

    public function store(Request $request)
    {
    	$rules=[
    		'title'=>'required|max:225'
    	];
    	$Validator=Validator::make($request->all(),$rules);
    	if ($Validator->fails()) {
    		return response()->json($Validator->errors(),400);
    	}
    	$poll=Poll::create($request->all());
    	return response()->json($poll,201);
    }

    public function update(Poll $poll,Request $request)
    {
    	$poll->update($request->all());
    	return response()->json($poll,200);
    }

    public function destroy(Poll $poll)
    {
    	$poll->delete();
    	return response()->json(["Deleted"],204);
    }


    public function errors()
    {
    	return response()->json(['msg'=>'Payment is required'],501);
    }

    public function Questions(Request $request,Poll $poll)
    {
    	$Questions=$poll->questions;

    	return response()->json($Questions,200);


    }
}
