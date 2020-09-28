<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name','slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public static function storeCategory(array $data){
        $data = array_merge($data,['slug'=>Str::slug($data['name'])]);
        return Category::create($data);
    }

    public static function getAllCategories(){
        return Category::latest()->get();
    }
}
