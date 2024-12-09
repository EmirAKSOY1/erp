<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SuppliersController extends Controller
{
    public function index(){
        $suppliers = Supplier::paginate(10);
        return view("admin.supplier.index",compact('suppliers'));
    }
    public function create(){
        return view("admin.supplier.create");
    }
    public function store(Request $request){
                // Validasyon kuralları
                $request->validate([
                    'name' => 'required|string|max:255',
                    'full' => 'required|string|max:255',
                    'bank' => 'nullable|string|max:255',
                    'iban' => 'nullable|string|max:255',
                    'vkn' => 'nullable|string|max:255',
                    'vd' => 'nullable|string|max:255',
                    'adress' => 'nullable|string|max:255',
                    'tel' => 'nullable|string|max:20',
                    'contact_person' => 'nullable|string|max:255',
                    'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Logo için validasyon
                    'note' => 'nullable|string',
                ]);
        
                // Logo yükleme işlemi
                if ($request->hasFile('logo')) {
                    $logo = $request->file('logo');
                    $logoName = time() . '_' . $logo->getClientOriginalName();
                    $logo->move(public_path('uploads/suppliers'), $logoName);
                } else {
                    $logoName = null;
                }
        
                // Tedarikçi verisini kaydetme
                $supplier = new Supplier();
                $supplier->company_name = $request->name;
                $supplier->company_full_name = $request->full;
                $supplier->bank_name = $request->bank;
                $supplier->iban = $request->iban;
                $supplier->tax_number = $request->vkn;
                $supplier->tax_office = $request->vd;
                $supplier->address = $request->adress;
                $supplier->phone_number = $request->tel;
                $supplier->contact_person = $request->contact_person;
                $supplier->company_logo = $logoName; // Logo dosya adını kaydet
                $supplier->notes = $request->note;
                $supplier->status = 'active';
                $supplier->save();
        
                return redirect()->back()->with('success', 'Tedarikçi başarıyla kaydedildi.');
    }
    public function edit($id){
        $supplier = Supplier::findOrFail($id);
        return view("admin.supplier.edit",compact('supplier'));
    }
    public function update(Request $request, $id)
    {
        // Tedarikçi verisini veritabanından al
        $supplier = Supplier::findOrFail($id);
    
        // Form doğrulama
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_full_name' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'iban' => 'nullable|string|max:255',
            'tax_number' => 'nullable|string|max:255',
            'tax_office' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'notes' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive', // status değeri zorunlu
        ]);
    
        // Logo işlemi
        if ($request->hasFile('company_logo')) {
            // Yeni logo yüklendiyse, eski logoyu sil
            if ($supplier->company_logo) {
                $oldLogoPath = public_path('uploads/suppliers/' . $supplier->company_logo);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }
    
            // Yeni logo yükle
            $logo = $request->file('company_logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/suppliers'), $logoName);
    
            // Logo adını veritabanına kaydet
            $supplier->company_logo = $logoName;
        }
    
        // Veritabanındaki diğer bilgileri güncelle
        $supplier->company_name = $request->input('company_name');
        $supplier->company_full_name = $request->input('company_full_name');
        $supplier->bank_name = $request->input('bank_name');
        $supplier->iban = $request->input('iban');
        $supplier->tax_number = $request->input('tax_number');
        $supplier->tax_office = $request->input('tax_office');
        $supplier->address = $request->input('address');
        $supplier->phone_number = $request->input('phone_number');
        $supplier->contact_person = $request->input('contact_person');
        $supplier->notes = $request->input('notes');
        $supplier->status = $request->input('status');
    
        // Güncellemeyi kaydet
        $supplier->save();
    
        // Başarı mesajı ve yönlendirme
        return redirect()->route('supplier.index')->with('success', 'Tedarikçi başarıyla güncellendi.');
    }
    
    public function destroy($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
    
            return response()->json(['success' => 'Tedarikçi başarıyla silindi.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Tedarikçi silinirken bir hata oluştu.'], 500);
        }
    }
      
    public function show($id){
        $supplier = Supplier::findOrFail($id);
        return view("admin.supplier.show",compact('supplier'));
    }
}
