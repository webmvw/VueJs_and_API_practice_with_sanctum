<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;

class BlogtestController extends Controller
{
    public function store(Request $request){
    	$rules = array(
    		'title'=>'required',
    		'description'=>'required',
    	);
    	$validator = Validator::make($request->all(),$rules);
    	if($validator->fails()){
    		return $validator->errors();
    	}else{
    		$blog = new Blog;
    		$blog->title = $request->title;
    		$blog->description = $request->description;
    		if($request->hasfile('image')){
	            $file = $request->file('image');
	            $filename = time().$file->getClientOriginalName();
	            $file->move('uploads/',$filename);
	            $blog->image = $filename;
	        }
    		$result = $blog->save();
    		if($result){
	    		return ["result"=>"Data added success"];
	    	}else{
	    		return ["result"=>"Data not added"];
	    	}
    	}
    }
}
