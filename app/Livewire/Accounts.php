<?php

namespace App\Livewire;

use App\Models\Account;
use Livewire\Component;

class Accounts extends Component
{
    public $accounts;

    public $description;

    public function mount()
    {
        $this->accounts = auth()->user()->accounts;
    }

    public function create()
    {
        $this->validate([
            'description' => 'required|min:4'
        ]);

        $account = new Account();
        $account->user_id = auth()->id();
        $account->cod = uniqid('acc_');
        $account->description = $this->description;
        $account->save();

        $this->redirect('accounts');
    }

    public function delete(Account $account)
    {
        //policy
        $account->delete();
        return redirect('accounts');
    }

    public function render()
    {
        // dd(55);
        return view('livewire.accounts',[
            'accounts' => Account::where('user_id', auth()->id())->get()
        ]);
    }
}
