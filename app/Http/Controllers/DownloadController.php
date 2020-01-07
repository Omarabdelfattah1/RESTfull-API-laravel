<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function show()
    {
    	return response()->download('files/test.pdf','file to download');
    }

    public function create(Request $request)
    {
    	$path=$request->file('file')->store('test');
    	return response()->json(['path'=>$path],200);
    }
}
