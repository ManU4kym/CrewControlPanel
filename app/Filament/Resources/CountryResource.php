<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Country;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\CountryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Filament\Resources\CountryResource\RelationManagers\StatesRelationManager;
use App\Filament\Resources\CountryResource\RelationManagers\EmployeesRelationManager;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static? string $navigationLabel = 'Country';

    protected static ? string $navigationGroup = 'System Management';

    protected static ? string $modelLabel = 'Employees Countries';

    protected static  ?int $navigationSort = 1;

    public static function getNavigationBadgeColor(): ?string
{
    return static::getModel()::count() > 10 ? 'warning' : 'primary';
}

   

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('code')
                ->required()
                ->maxLength(3),
                Forms\Components\TextInput::make('phone_number')
                ->required()
                ->numeric()
                ->maxLength(5)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
                Tables\Columns\TextColumn::make('code')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('phonecode')
                ->searchable()
                ->numeric()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
           Section::make('Country Info')
           ->schema([
            TextEntry::make('name'),
            TextEntry::make('code')->label('country_code'),
            TextEntry::make('phonecode')->label('phonecode'),
           ])
        ]);
}
    
    public static function getRelations(): array
    {
        return [
            StatesRelationManager::class,
            EmployeesRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }    
}
