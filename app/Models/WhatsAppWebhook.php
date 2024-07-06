<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppWebhook extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_PROCESEED = 2;

    protected $table = 'whatsapp_webhooks';

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
