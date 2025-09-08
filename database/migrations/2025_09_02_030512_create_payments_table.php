<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->char('order_id', 36);
                $table->decimal('amount', 15, 2);
                $table->string('status')->default('pending');
                $table->string('payment_method')->nullable();
                $table->string('transaction_id')->nullable();
                $table->timestamps();
            });
        }
    }


    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
