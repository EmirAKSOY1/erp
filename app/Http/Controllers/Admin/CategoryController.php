<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Ana kategoriler
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function getSubcategories($parentId)
    {
        // Veritabanında alt kategoriler sorgulandı mı kontrol edin
        $subcategories = Category::where('parent_id', $parentId)->get();
        
        // Eğer alt kategori yoksa
        if ($subcategories->isEmpty()) {
            return response()->json(['message' => 'No subcategories found'], 404);
        }
    
        return response()->json($subcategories);
    }
}
