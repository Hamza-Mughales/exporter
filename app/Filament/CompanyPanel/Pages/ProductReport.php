<?php

namespace App\Filament\CompanyPanel\Pages;

use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use App\Filament\Exports\ProductExporter;
use App\Models\Product;
use Filament\Facades\Filament;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;

class ProductReport extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.company-panel.pages.product-report';

    public function getTitle(): string
    {
        return 'Product Report';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Product::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('price')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
                Tables\Columns\TextColumn::make('company.name'),
                ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([])
            ->headerActions([
                ExportAction::make()
                ->exporter(ProductExporter::class)
                ->modifyQueryUsing(fn ($query) => $query->where('company_id', Filament::getTenant()?->id)),

            ]);
    }
}
