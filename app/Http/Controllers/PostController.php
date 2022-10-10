<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function index(){

        // $posts = Post::paginate(3);
        $posts = Post::all();

        return response()->json($posts);
    }
    public function createPost(Request $request){

        $validator = Validator::make($request->all(),[
            "title" => "required",
            "body" => "required | min:5",
        ]);

        if($validator->fails()){
            // error message 
            return response()->json([
                "status" => "error",
                "errors" =>$validator->errors()
            ]);
        }

        $post = new Post();      
        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        // success message 
        return response()->json([
            "status" =>"success",
            "data"=>$post
        ]);
    }
    public function updatePost(Request $request,$id){

        $validator = Validator::make($request->all(),[
            "title" => "required",
            "body" => "required | min:5",
        ]);

        if($validator->fails()){
            // error message 
            return response()->json([
                "status" => "error",
                "errors" =>$validator->errors()
            ]);
        }

        // update data 
        $post = Post::find($id);

        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        return response()->json([
            "status" =>"success",
            "data"=>$post
        ]);
       

    }
    public function deletePost($id){
        
        $post = Post::find($id);

        if($post->delete()){

            return response()->json([
                "status" =>"success",
                "data"=>$post
            ]);
        }
        

      
       
    }
}
