<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;


class CategoryController extends Controller
{
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return $id;
    }

    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        $category->title = $request->content;
        $category->save();

        return $category;
    }
}
