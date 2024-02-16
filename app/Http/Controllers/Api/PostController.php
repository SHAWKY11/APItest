<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{
    use ApiResponseTrait;

    public function index(){
        $posts=Post::get();
        return $this->apiResponse($posts,'ok',200);
    }

    public function show($id){
        $posts=Post::find($id);
        if($posts){
        return $this->apiResponse($posts,'ok',200);
        }
        else {
            return $this -> apiResponse(null,"Post not found",404);
        }
    }

     public function delete($id){
        $posts=Post::find($id);
        if($posts){
            $posts->delete();
            return $this -> apiResponse(null, "Post deleted successfully", 200);
        }
        else {
            return $this -> apiResponse(null,"Post not found",404);
        }
    }

    public function store(Request $request){
            $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails())
        {
            return $this -> apiResponse(null,$validator->errors(),400);
        }
        
        $posts=Post::create( $request->all() );  //insert data into database
        if($posts){
        return $this->apiResponse($posts,'True',200);
        }
        else {
            return $this -> apiResponse(null,"Unknown",400);
        }
    }

    public function update($id,Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails())
        {
            return $this -> apiResponse(null,$validator->errors(),400);
        }
         $posts=Post::find($id);
        if(!$posts){
        return $this -> apiResponse(null,"Not Found",400);
        }
        
        $posts->update( $request->all() );  //insert data into database
        if($posts){
        return $this->apiResponse($posts,'True',200);
        }
        else {
            return $this -> apiResponse(null,"Unknown",400);
        }
    }
}

