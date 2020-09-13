<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

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
        return Question::create($data);
    }

    public static function getAllQuestions(){
        return Question::with('user','category')->latest()->get();
    }
    public function path(){
        return asset("api/question/$this->slug");
    }

}
