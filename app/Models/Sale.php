<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    use HasFactory;

    protected $fillable = [
        'product_id',
        'customer_id',
        'customer_name',
        'quantity',
        'price_per_unit',
        'total_sale',
        'sale_date',
    ];

    // Define relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Accessor to get the total sale automatically
    public function calculateTotalSale()
    {
        return $this->quantity * $this->price_per_unit;
    }
    
}
