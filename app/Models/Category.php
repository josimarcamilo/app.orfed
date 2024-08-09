<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'cod',
        'description',
        'planned',
        'real'
    ];

    protected static function booted(): void
    {
        static::creating(function (Category $model) {
            $model->account_id = auth()->user()->account->id;
            $model->cod = uniqid('cat_');
        });
    }

    public function extracts()
    {
        return $this->hasMany(Extract::class);
    }

    public function sumValueReal()
    {
        $total = $this->extracts()->sum('amount');
        $this->real = $total;
        $this->save();
    }
}
