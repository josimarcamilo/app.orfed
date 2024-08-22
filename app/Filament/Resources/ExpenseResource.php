<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\Widgets\ExpensesByCategory;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Despesas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('budget_id')->required()
                    ->relationship(name: 'budget', titleAttribute: 'description')
                    ->searchable()
                    ->preload()
                    ->native(false),
                Forms\Components\TextInput::make('description')->required(),
                Forms\Components\Select::make('category')->required()
                    ->relationship(name: 'category', titleAttribute: 'description')
                    ->searchable()
                    ->preload()
                    ->native(false),
                Forms\Components\TextInput::make('amount')->required(),
                
                Forms\Components\Select::make('status')->required()
                ->options([
                    1 => 'Pendente',
                    2 => 'Pago',
                ])->native(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')->label('Descrição')->searchable(),
                Tables\Columns\TextColumn::make('category.description')->label('Categoria')
                    ,
                Tables\Columns\TextInputColumn::make('amount'),
                Tables\Columns\SelectColumn::make('status')->options([
                    1 => 'Pendente',
                    2 => 'Pago',
                ])->selectablePlaceholder(false),
                
                Tables\Columns\TextColumn::make('created_at')->label('Criada em')
            ])
            ->filters([
                SelectFilter::make('budget')
                    ->relationship('budget', 'description')
                    ->native(false)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageExpenses::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ExpensesByCategory::class
        ];
    }
}
