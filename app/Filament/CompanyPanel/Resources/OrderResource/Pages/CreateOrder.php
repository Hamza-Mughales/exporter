<?php

namespace App\Filament\CompanyPanel\Resources\OrderResource\Pages;

use App\Filament\CompanyPanel\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
