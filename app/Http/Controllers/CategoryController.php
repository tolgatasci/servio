<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Subcategory::with('services')->get();
        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Subcategory::with('services')->findOrFail($id);
        return view('categories.show', compact('category'));
    }
}
