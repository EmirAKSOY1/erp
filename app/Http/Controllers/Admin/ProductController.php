<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;
class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(10);
        return view("admin.products.index",compact("products"));
    }
    public function create(){
        $categories = Category::all();
        $currencies = Currency::all();
        return view("admin.products.create",compact("categories","currencies"));
    }
    public function store(Request $request)
    {
        // Form doğrulama kuralları
        $validatedData = $request->validate([
            'barcode' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock_quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'vat' => 'required|numeric|min:0',
            'currency_id' => 'required|integer',
            'stock_warning_quantity' => 'required|integer|min:0',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2 MB sınırı
        ]);

        // Dosya yükleme işlemi
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/products'), $imageName);
            $imagePath = 'uploads/products/' . $imageName;
        } else {
            $imagePath = null;
        }

        // Yeni ürün oluşturma
        Product::create([
            'barcode' => $validatedData['barcode'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'stock_quantity' => $validatedData['stock_quantity'],
            'unit' => $validatedData['unit'],
            'purchase_price' => $validatedData['purchase_price'],
            'sale_price' => $validatedData['sale_price'],
            'discount' => $validatedData['discount'],
            'vat' => $validatedData['vat'],
            'currency_id' => $validatedData['currency_id'],
            'stock_warning_quantity' => $validatedData['stock_warning_quantity'],
            'category_id' => $validatedData['category_id'],
            'image' => $imagePath,
        ]);

        // Başarılı ekleme sonrası yönlendirme
        return redirect()->route('products.index')->with('success', 'Ürün başarıyla eklendi.');
    }
    public function destroy($id)
{
    // Ürünü bul
    $product = Product::findOrFail($id);

    // Eğer ürünün resmi varsa ve dosya mevcutsa sil
    if ($product->image && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }

    // Ürünü veritabanından sil
    $product->delete();

    // Başarılı silme sonrası yönlendirme
    return response()->json(['success' => 'Ürün başarıyla silindi.'], 200);
}
public function edit($id)
{
    // Ürünü ID'ye göre al
    $product = Product::findOrFail($id);

    // Kategorileri ve para birimlerini al
    $categories = Category::all();
    $currencies = Currency::all();

    // Düzenleme sayfasını döndür
    return view('admin.products.edit', compact('product', 'categories', 'currencies'));
}
public function update(Request $request, $id)
{
    // Form verisi doğrulama
    $validated = $request->validate([
        'barcode' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'stock_quantity' => 'required|integer',
        'unit' => 'required|string|max:255',
        'stock_warning_quantity' => 'required|integer',
        'purchase_price' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'discount' => 'nullable|numeric',
        'vat' => 'required|numeric',
        'currency_id' => 'required|exists:currencies,id',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Yalnızca resim dosyaları kabul edilir
    ]);

    // Ürünü al
    $product = Product::findOrFail($id);

    // Ürün bilgilerini güncelle
    $product->barcode = $request->barcode;
    $product->name = $request->name;
    $product->description = $request->description;
    $product->stock_quantity = $request->stock_quantity;
    $product->unit = $request->unit;
    $product->stock_warning_quantity = $request->stock_warning_quantity;
    $product->purchase_price = $request->purchase_price;
    $product->sale_price = $request->sale_price;
    $product->discount = $request->discount;
    $product->vat = $request->vat;
    $product->currency_id = $request->currency_id;
    $product->category_id = $request->category_id;

    if ($request->hasFile('image')) {
        // Önce eski resmi sil
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image)); // Eski resmi sil
        }

        // Yeni resmi kaydet
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/products'), $imageName);
        $imagePath = 'uploads/products/' . $imageName;
        $product->image = $imagePath;
    } else {
        // Resim yüklenmemişse mevcut resmi koru
        $imagePath = $product->image;
    }

    // Ürünü güncelle
    $product->save();

    // Başarıyla güncellendikten sonra ürünler listesine dön
    return redirect()->route('products.index')->with('success', 'Ürün başarıyla güncellendi.');
}
public function import(Request $request)
{
    // Dosya doğrulaması
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    // Excel dosyasını import etme
    Excel::import(new ProductsImport, $request->file('file'));

    return redirect()->route('products.index')->with('success', 'Ürünler başarıyla yüklendi!');
}
public function export()
{
    return Excel::download(new ProductExport, 'products.xlsx');
}
}
