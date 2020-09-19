<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Question extends Model
{
    protected $fillable = ['title','slug','body','user_id','category_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public static function storeQuestion(array $data){
        $data = array_merge($data,['slug'=>Str::slug($data['title'])]);
        return Question::create($data);
    }

    public static function getAllQuestions(){
        return Question::with('user','category')->latest()->get();
    }

    public function path(){
        return asset("api/question/$this->slug");
    }

}
