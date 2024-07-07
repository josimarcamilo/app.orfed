<?php

use App\Models\BraipWebhook;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('braip_webhooks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('payload');
            $table->smallInteger('status')->default(BraipWebhook::STATUS_PENDING)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('braip_webhooks');
    }
};
