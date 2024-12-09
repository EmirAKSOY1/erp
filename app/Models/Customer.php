<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'first_name', 
        'last_name', 
        'company_name', 
        'company_full_name', 
        'tax_number', 
        'tax_office', 
        'address', 
        'phone_number', 
        'email', 
        'country', 
        'customer_type', 
        'contact_person', 
        'vkn', 
        'notes', 
        'iban',
        'status'
    ];

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];
}
