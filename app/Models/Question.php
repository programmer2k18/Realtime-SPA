<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Question extends Model
{
    protected $fillable = ['title','slug','body','user_id','category_id'];
    protected $with = ['replies'];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class)->latest();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public static function storeQuestion(array $data){
        $data = array_merge($data,['slug'=>Str::slug($data['title'])
        ,'user_id'=>auth()->id()]);
        return Question::create($data);
    }

    public static function getAllQuestions(){
        return Question::with('user')->latest()->get();
    }

    public function path(){
        return "question/$this->slug";
    }

}
