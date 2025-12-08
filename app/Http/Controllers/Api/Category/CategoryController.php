<?php

namespace App\Http\Controllers\Api\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return CategoryResource::collection(Category::paginate(12));
    }

    public function show(Category $category)
    {
        return $this->success(new CategoryResource($category));
    }
}
