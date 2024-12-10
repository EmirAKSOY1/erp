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
        $categories = Category::with('parent')->paginate(10);
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
    
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);
    
        return redirect()->route('category.index')->with('success', 'Kategori başarıyla eklendi.');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->children()->count() > 0) {
            return response()->json(['error' => 'Bu kategoriyi silmeden önce alt kategorileri silmelisiniz.'], 400);
        }
        $category->delete();

        return response()->json(['success' => 'Kategori başarıyla silindi.']);
    }
    public function edit($id)
{
    $category = Category::findOrFail($id);
    $categories = Category::where('id', '!=', $id)->get(); // Kendisini dışlayarak diğer kategorileri al

    return response()->json([
        'category' => $category,
        'categories' => $categories
    ]);
}
public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'parent_id' => 'nullable|exists:categories,id'
    ]);

    $category->update([
        'name' => $request->name,
        'description' => $request->description,
        'parent_id' => $request->parent_id
    ]);

    return response()->json(['success' => 'Kategori başarıyla güncellendi.']);
}
}
