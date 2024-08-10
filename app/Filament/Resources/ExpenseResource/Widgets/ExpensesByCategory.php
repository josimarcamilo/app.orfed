<?php

namespace App\Filament\Resources\ExpenseResource\Widgets;

use App\Models\Budget;
use App\Models\Expense;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\DB;

class ExpensesByCategory extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $budgetId = $this->filter;
        if(is_null($budgetId))
        {
            $budgetId = array_key_first($this->getFilters());
        }

        $data = Expense::with('category:id,description')
            ->where('budget_id', $budgetId)
            ->select(DB::raw('category_id, sum(amount) as Total'))
            ->groupBy(['category_id'])
            ->orderBy('Total', 'desc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Bloeg posts created',
                    'data' => $data->map(fn ($row) => $row->Total),
                ],
            ],
            'labels' => $data->map(fn ($row) => $row->category->description),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
        return Budget::myAccount()
            ->select(['id', 'description'])
            ->orderBy('id','desc')
            ->get()
            ->pluck('description', 'id')
            ->toArray();
    }
}
