<?php

namespace App\Http\Controllers;

use App\Http\Resources\Reply\ReplyResource;
use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function likeReply(Reply $reply){

        $reply->likes()->create([
            'user_id' => 1
        ]);
        return response( new ReplyResource($reply),201);
    }

    public function unLikeReply(Reply $reply){

        $reply->likes()->where('user_id', 1)->first()->delete();
        return response( new ReplyResource($reply),200);
    }
}
