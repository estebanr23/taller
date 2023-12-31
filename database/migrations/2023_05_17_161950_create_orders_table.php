<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->nullable()->constrained(); /** Campo null */
            $table->foreignId('customer_id')->constrained();
            $table->string('receiver_user'); // Usuario receptor
            $table->foreignId('user_id')->nullable(); // Usuario tecnico
            $table->string('problem');
            $table->string('accessories')->nullable();
            $table->string('report_customer')->nullable();
            $table->string('report_technical')->nullable();
            $table->date('date_emission'); // Fecha de recepcion
            $table->time('time_emission', $precision = 0); // Hora de recepcion
            $table->date('date_promise'); // Fecha prometida
            $table->date('date_delivery')->nullable();
            $table->foreignId('state_id')->constrained();
            $table->string('type_order')->nullable(); /** Campo null */
            $table->boolean('remote_repair');
            $table->foreignId('ticket_id')->constrained();
            $table->enum('created_order', ['Taller', 'Domicilio']); // Orden de taller o domicilio
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
