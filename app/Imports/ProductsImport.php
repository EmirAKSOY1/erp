<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'barcode' => $row[0],  // Excel dosyasındaki barkod sütunu
            'name' => $row[1],      // Excel dosyasındaki ürün adı
            'description' => $row[2], // Açıklama
            'stock_quantity' => $row[3],  // Stok Miktarı
            'unit' => $row[4],     // Birim
            'stock_warning_quantity' => $row[5], // Stok uyarı miktarı
            'purchase_price' => $row[6], // Alış fiyatı
            'sale_price' => $row[7],  // Satış fiyatı
            'discount' => $row[8], // İskonto
            'vat' => $row[9],     // KDV
            'currency_id' => $row[10], // Para birimi ID'si
            'category_id' => $row[11], // Kategori ID'si
            'image' => $row[12], // Ürün resmi (dosya adı veya yol)
        ]);
    }
}
