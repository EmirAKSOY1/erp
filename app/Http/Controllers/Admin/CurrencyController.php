<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
class CurrencyController extends Controller
{
    public function index(){
        $currencies = Currency::paginate(10);
        return view("admin.settings.currency",compact("currencies"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10',
            'abbreviation' => 'required|string|max:10',
            'rate' => 'required|numeric',
        ]);

        // Yeni para birimi ekleme
        Currency::create([
            'name' => $request->name,
            'symbol' => $request->symbol,
            'abbreviation' => $request->abbreviation,
            'rate' => $request->rate,
        ]);

        // Başarı mesajı ve yönlendirme
        return redirect()->back()->with('success', 'Para birimi başarıyla eklendi!');
    }
    public function destroy($id)
    {
        // Veritabanında belirtilen id'ye sahip para birimini bul
        $currency = Currency::findOrFail($id);

        // Para birimini sil
        $currency->delete();

        return response()->json(['success' => 'Para birimi başarıyla silindi.']);
    }
    public function edit($id)
    {
        // Veritabanından ilgili para birimini al
        $currency = Currency::findOrFail($id);

        // Para birimi verisini döndür (ajax ile modal açılacak)
        return response()->json($currency);
    }
    public function update(Request $request, $id)
    {
        // Validasyon
        $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10',
            'abbreviation' => 'required|string|max:5',
            'rate' => 'required|numeric',
        ]);

        // Veritabanından ilgili para birimini al
        $currency = Currency::findOrFail($id);

        // Para birimi verilerini güncelle
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->abbreviation = $request->abbreviation;
        $currency->rate = $request->rate;

        // Güncellenmiş veriyi kaydet
        $currency->save();

        // Başarı mesajı ile geri yönlendir
        return response()->json(['success' => 'Para birimi başarıyla güncellendi!']);
    }
}
