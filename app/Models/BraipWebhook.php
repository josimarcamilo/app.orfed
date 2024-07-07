<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BraipWebhook extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_PROCESEED = 2;

    protected $casts = [
        'payload' => 'json'
    ];

    public function saveWebhook($data)
    {
        $model = new self();
        $model->payload = $data;
        $model->save();
    }
}
