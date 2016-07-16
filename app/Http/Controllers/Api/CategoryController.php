<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        $category = Category::create([
            'name' => $request->get('name')
        ]);

        return $category->toArray();
    }
}
