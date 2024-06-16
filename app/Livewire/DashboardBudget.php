<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Budget as BudgetModel;
use App\Models\Category;
use App\Models\Extract;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard Budget')]
class DashboardBudget extends Component
{
    public $account;
    public $budget;

    public $categoryDescription;

    public $entryDescription;
    public $entryAmount;

    public function mount(Account $account, BudgetModel $budget)
    {
        $this->account = $account;
        $this->budget = $budget;
    }

    public function createCategory()
    {
        $this->validate([
            'categoryDescription' => 'required|min:4'
        ]);

        $account = new Category();
        $account->account_id = $this->account->id;
        $account->budget_id = $this->budget->id;
        $account->cod = uniqid('cat_');
        $account->description = $this->categoryDescription;
        $account->save();

        $this->redirect('/accounts/'.$this->account->id.'/budgets/'.$this->budget->id, true);
    }

    public function deleteCategory(Category $category)
    {
        //policy
        $category->delete();
        $this->redirect('/accounts/'.$this->account->id.'/budgets/'.$this->budget->id, true);
    }

    public function createEntry()
    {
        $this->validate([
            'entryDescription' => 'required|min:4',
            'entryAmount' => 'required|integer|min:4'
        ]);

        $account = new Extract();
        $account->type = Extract::ENTRY;
        $account->account_id = $this->account->id;
        $account->budget_id = $this->budget->id;
        $account->cod = uniqid('ext_');
        $account->description = $this->entryDescription;
        $account->amount = $this->entryAmount;
        $account->save();

        $this->redirect('/accounts/'.$this->account->id.'/budgets/'.$this->budget->id, true);
    }

    public function deleteExtract(Extract $extract)
    {
        //policy
        $extract->delete();
        $this->redirect('/accounts/'.$this->account->id.'/budgets/'.$this->budget->id, true);
    }
    
    public function render()
    {
        return view('livewire.dashboard-budget',[
            'categories' => $this->budget->categories,
            'entries' => $this->budget->entries
        ]);
    }
}
