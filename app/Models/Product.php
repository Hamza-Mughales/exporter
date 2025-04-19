<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'company_id',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('company', function (Builder $query) {
            // Grab the current tenant (Company) from the Filament panel
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
