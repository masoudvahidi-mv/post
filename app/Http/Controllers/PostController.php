<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $users=User::all();
        $post=Post::query()->latest('id')->first();
        return view('post.index',compact('users','post'));
    }

    public function store(Request $request){
        $error=false;
        try{
            // check for 3 layers only
            $post=Post::with('comments')->find($_POST['postid']);
            if($post->comments->count()>=3){
                $error=true;
                $message=__('messages.3layers');
            }else{
                // create comment in database
                $comment=new Comment();
                $comment->preview_id=$_POST['id'];
                $comment->reply=$_POST['comment'];
                $comment->created_at=date('Y-m-d');
                $comment->save();

                // create relation post and comment
                $post=Post::find($_POST['postid']);
                $comment->posts()->attach($post);
                $error=false;
                $message=__('messages.comment');
            }

        }catch (\Exception $e){

            echo json_encode([
                'data'=>[
                    'error'=>true,
                    'message'=>$e->getMessage()
                ]
            ]);
            die();
        }


        echo json_encode([
            'data'=>[
                'error'=>$error,
                'message'=>$message
            ]
        ]);
        die();
    }

    public function create(){
        Post::query()->insert([
           'user_id'=>1,
            'message'=>'It has survived not only five centuries? Investor Spotlight'
        ]);

        return redirect()->back();
    }
}
