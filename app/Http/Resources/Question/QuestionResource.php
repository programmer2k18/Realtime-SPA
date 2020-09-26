<?php

namespace App\Http\Resources\Question;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title'=>$this->title,
            'body'=>$this->body,
            'path'=>$this->path(),
            'author'=>$this->user->name,
            'user_id'=>$this->user_id,
            'created_at'=>$this->created_at->format('d M H:i'),
        ];
    }
}
