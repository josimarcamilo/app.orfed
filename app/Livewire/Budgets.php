<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Budget;
use Livewire\Component;

class Budgets extends Component
{
    public $reference;

    public $rows;
    public $account;

    public function mount(Account $account)
    {
        $this->account = $account;
        $this->rows = $account->budgets;
    }

    public function create()
    {
        $this->validate([
            'reference' => 'required|date'
        ]);

        $account = new Budget();
        $account->account_id = $this->account->id;
        $account->cod = uniqid('bud_');
        $account->reference = $this->reference;
        $account->save();

        $this->redirect('/accounts/'.$this->account->id.'/budgets', true);
    }

    public function delete(Budget $model)
    {
        //policy
        $model->delete();
        $this->redirect('/accounts/'.$this->account->id.'/budgets', true);
    }

    public function render()
    {
        return view('livewire.budgets', [
            'rows' => $this->rows
        ]);
    }
}
