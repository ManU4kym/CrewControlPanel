<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use Filament\Actions;
use App\Models\Employee;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmployeeResource;


class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array{
        return [
           'All' => Tab::make(), 
           'This Week' => Tab::make()
           ->modifyQueryUsing(fn (Builder $query) => $query->where('hired_date', '>=', now()->subWeek()))
           ->badge(Employee::query()->where('hired_date', '>=', now()->subWeek())->count()),
           'This Month' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('hired_date', '>=', now()->subMonth()))
           ->badge(Employee::query()->where('hired_date', '>=', now()->subMonth())->count()),
           'This Year' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('hired_date', '>=', now()->subYear()))
           ->badge(Employee::query()->where('hired_date', '>=', now()->subYear())->count()),
        ];
    }
}
