<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'parent_id'
    ];

    // Alt kategoriyi almak için ilişki
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Alt kategorileri almak için ilişki
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
