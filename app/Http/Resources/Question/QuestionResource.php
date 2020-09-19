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
            'category'=>$this->category->name,
            'comments'=>$this->replies,
            'created_at'=>$this->created_at->format('d M H:i'),
        ];
    }
}
