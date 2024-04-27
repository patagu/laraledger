<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookEntryResource\Pages;
use App\Filament\Resources\BookEntryResource\RelationManagers;
use App\Models\BookEntry;
use App\Enums\BookEntryStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookEntryResource extends Resource
{
    protected static ?string $model = BookEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->autofocus(true)
                    ->displayFormat('d/m/Y')
                    ->required()
                    ->native(true)
                    ->firstDayOfWeek(1)
                    ->default(now()),
                Forms\Components\TextInput::make('debit')
                    // ->requiredIf('credit', '=', 0)
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->live(), // sets livewire to listen to changes on this field
                Forms\Components\TextInput::make('credit')
                    // ->requiredIf('debit', '=', 0)
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\Select::make('account_id')
                    ->relationship('account', 'name', function(Builder $query, Get $get) {
                        if ($get('debit') > 0) { // $get is some magic livewire function to get the form request
                            $query->where('nature', '=', 'liability');
                        }
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->required()
                    ->enum(BookEntryStatus::class)
                    ->options(BookEntryStatus::class)
                    ->default(BookEntryStatus::active)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('debit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('credit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('account.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookEntries::route('/'),
            'create' => Pages\CreateBookEntry::route('/create'),
            'edit' => Pages\EditBookEntry::route('/{record}/edit'),
        ];
    }
}
