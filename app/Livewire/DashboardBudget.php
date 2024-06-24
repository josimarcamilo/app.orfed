<?php

namespace App\Livewire;

use App\Dtos\ExtractImport;
use App\Models\Account;
use App\Models\Budget as BudgetModel;
use App\Models\Category;
use App\Models\Extract;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Dashboard Budget')]
class DashboardBudget extends Component
{
    use WithFileUploads;

    public $account;
    public $budget;

    public $categoryDescription;

    public $entryDescription;
    public $entryAmount;

    public $extractFile;

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

    public function updateExtract(Extract $extract, array $data)
    {
        //policy

        $category = $extract->category;

        if($data['category_id'] == 'selecione'){
            $data['category_id'] = null;
        }
        $extract->description = $data['description'];
        $extract->amount = $data['amount'];
        $extract->date = $data['date'];
        $extract->category_id = $data['category_id'];
        $extract->save();

        if($extract->category_id){
            $extract->refresh();

            $extract->category->sumValueReal();
        }

        if($category){
            $category->sumValueReal();
        }
    }

    public function deleteExtract(Extract $extract)
    {
        //policy
        $extract->delete();
        $this->redirect('/accounts/'.$this->account->id.'/budgets/'.$this->budget->id, true);
    }

    public function importExtract()
    {
        $fileContents = file($this->extractFile->getPathname());
        
        foreach ($fileContents as $key => $line) {
            if($key == 0){
                continue;
            }
            $data = str_getcsv($line);
            // 0 => "Data"
            // 1 => "Valor"
            // 2 => "Identificador"
            // 3 => "Descrição"

            $dto = new ExtractImport();
            $dto->setDate($data[0], 'd/m/Y');
            $dto->description = $data[3];
            $dto->id = $data[2];
            $dto->setValue($data[1]);

            if(Extract::where('external_id', $dto->id)->exists()){
                continue;
            }

            $account = new Extract();
            $account->type = $dto->type;
            $account->account_id = $this->account->id;
            $account->budget_id = $this->budget->id;
            $account->cod = uniqid('ext_');
            $account->description = $dto->description;
            $account->amount = $dto->value;
            $account->external_id = $dto->id;
            $account->date = $dto->date;
            $account->save();
        }

        $this->redirect('/accounts/'.$this->account->id.'/budgets/'.$this->budget->id, true);
    }
    
    public function render()
    {
        return view('livewire.dashboard-budget',[
            'categories' => $this->budget->categories,
            'entries' => $this->budget->entries,
            'exits' => $this->budget->exits,
            'balance' => $this->budget->balance()
        ]);
    }
}
