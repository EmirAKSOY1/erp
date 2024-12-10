<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    // Eklenecek alanlar
    protected $fillable = [
        'barcode',
        'name',
        'description',
        'stock_quantity',
        'unit',
        'purchase_price',
        'sale_price',
        'discount',
        'vat',
        'currency_id',
        'image',
        'stock_warning_quantity',
        'category_id',
    ];

    // İlişkiler
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
