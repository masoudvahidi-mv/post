<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComment(Request $request){

        $post=Post::find($_POST['postid']);
        $comments=$post->comments;

        // prepare data for front
        foreach ($comments as $c){
            $user=User::find($c->preview_id);
            $data[]=[
                'name'=>$user->name,
                'reply'=>$c->reply,
                'date'=>$c->created_at->format('Y-m-d'),
            ];

        }

        echo json_encode([
            'data'=>[
                'error'=>false,
                'comments'=>$data
            ]
        ]);
        die();
    }
}
