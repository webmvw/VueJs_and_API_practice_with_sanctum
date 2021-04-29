<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;


class TestApiController extends Controller
{
    public function view($id=null){
    	if($id){
    		$category = Category::find($id);
    		return response()->json($category, 200);
    	}else{
    		$categories = Category::all();
    		return response()->json($categories, 200);
    	}
    }

    public function store(Request $request){
    	$rules = array(
    		'name'=>'required',
    		'slug'=>'required'
    	);
    	$validator = Validator::make($request->all(),$rules);
    	if($validator->fails()){
    		return $validator->errors();
    	}else{
    		$category = new Category;
	    	$category->name = $request->name;
	    	$category->slug = $request->slug;
	    	$result = $category->save();
	    	if($result){
	    		return ["result"=>"Data added success"];
	    	}else{
	    		return ["result"=>"Data not added"];
	    	}
    	}
    }

    public function update(Request $request){
    	$category = Category::find($request->id);
    	$category->name = $request->name;
    	$category->slug = $request->slug;
    	$result = $category->save();
    	if($result){
    		return ["result"=>"Data updated success"];
    	}else{
    		return ["result"=>"Data not updated"];
    	}
    }

    public function delete($id){
    	$category = Category::find($id);
    	$result = $category->delete();
    	if($result){
    		return ["result"=>"Data deleted success"];
    	}else{
    		return ["result"=>"Data not deleted"];
    	}
    }

    public function search($param){
    	$category = Category::where('name', 'like', '%'.$param.'%')->get();
    	return response()->json($category, 200);
    }
}
