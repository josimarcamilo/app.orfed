<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'budget_id',
        'category_id',
        'description',
        'status',
        'amount'
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->account_id = auth()->user()->account->id;
            $model->cod = uniqid('exp_');
        });
    }

    public function scopeMyAccount(Builder $query): void
    {
        $query->where('account_id', auth()->user()->account->id);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
