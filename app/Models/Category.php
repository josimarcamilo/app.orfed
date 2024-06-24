<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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
