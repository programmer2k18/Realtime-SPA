<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
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
            'user_id' => auth()->id()
        ]);
        broadcast(new LikeEvent($reply->id,1))->toOthers();
        return response( 'liked',201);
    }

    public function unLikeReply(Reply $reply){

        $reply->likes()->where('user_id', auth()->id())->first()->delete();
        broadcast(new LikeEvent($reply->id,0))->toOthers();
        return response( 'disliked',200);
    }
}
