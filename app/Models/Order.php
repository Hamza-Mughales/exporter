<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

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

    protected static function booted(): void
    {
        static::addGlobalScope('company', function (Builder $query) {
            $tenant = Filament::getTenant();
            if ($tenant) {
                $query->where('company_id', $tenant->id);
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
