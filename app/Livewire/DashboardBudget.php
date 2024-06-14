<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Budget as BudgetModel;
use Livewire\Component;

class DashboardBudget extends Component
{
    public $account;
    public $budget;

    public function mount(Account $account, BudgetModel $budget)
    {
        $this->account = $account;
        $this->budget = $budget;
    }
    
    public function render()
    {
        return view('livewire.dashboard-budget');
    }
}
