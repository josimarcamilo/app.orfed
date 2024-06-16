<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

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
}
