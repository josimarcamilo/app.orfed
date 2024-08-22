<?php

namespace App\Filament\Resources\ExpenseResource\Widgets;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Expense;
use Filament\Widgets\ChartWidget;
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

        $categories = Category::myAccount()
            ->orderBy('description', 'desc')
            ->get();

        $data = Expense::where('budget_id', $budgetId)
            ->select(DB::raw('category_id, status, sum(amount) as Total'))
            ->groupBy(['category_id', 'status'])
            ->orderBy('Total', 'desc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Despesas pagas',
                    'data' => $categories->map(function ($category) use($data) { 
                         $row = $data->where('category_id', $category->id)->where('status', 2)->first();
                         return $row ? $row->Total : 0;
                    }),
                ],
                [
                    'label' => 'Despesas pendentes',
                    'data' => $categories->map(function ($category) use($data) { 
                         $row = $data->where('category_id', $category->id)->where('status', 1)->first();
                         return $row ? $row->Total : 0;
                    }),
                ],
            ],
            'labels' => $categories->map(fn ($row) => $row->description),
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
