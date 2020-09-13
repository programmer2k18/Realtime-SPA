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
            'username'=>$this->user->name,
            'category'=>$this->category->name,
            'created_at'=>$this->created_at->format('d M H:i'),
        ];
    }
}
