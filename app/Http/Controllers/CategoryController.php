<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::getAllCategories();
        return $categories?  response(CategoryResource::collection($categories),200):
            response(['msg'=>'No Available Categories yet.'],204);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateCategoryInputs($request);
        if ($validator->fails())
            return response(['msg'=>'Not complete or invalid parameters',
                'errors'=>$validator->errors()],206);

        $data = Category::storeCategory($validator->validated());
        return response($data,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response(new CategoryResource($category),200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = $this->validateCategoryInputs($request);
        if ($validator->fails())
            return response(['msg'=>'Not complete or invalid parameters',
                'errors'=>$validator->errors()],206);

        $data = array_merge($validator->validated(),['slug'=>Str::slug($request->name)]);
        $category->update($data);
        return response( new CategoryResource($category),200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        return $category->delete()?
            response(['msg'=>'Category deleted successfully'],200):
            response(['msg'=>'Something went wrong, Couldn\'t delete this Category'],404);
    }

    public function validateCategoryInputs(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);
        return $validator;
    }
}
