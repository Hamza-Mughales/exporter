<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id',
        'company_id',
        'quantity',
        'total_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($order) {
            $product = $order->product;
            if ($product) {
                $order->total_price = $order->quantity * $product->price;
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
