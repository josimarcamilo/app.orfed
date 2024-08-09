<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
    ];

    protected static function booted(): void
    {
        static::creating(function (Budget $model) {
            $model->account_id = auth()->user()->account->id;
            $model->cod = uniqid('bud_');
        });
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function entries()
    {
        return $this->hasMany(Extract::class)->where('type', Extract::ENTRY);
    }

    public function exits()
    {
        return $this->hasMany(Extract::class)->where('type', Extract::EXIT);
    }

    public function balance()
    {
        return $this->entries()->sum('amount') - $this->exits()->sum('amount');
    }
}
