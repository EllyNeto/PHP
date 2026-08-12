<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inscription_id')->nullable();
            $table->string('student_name');
            $table->string('course');
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('method')->default('Multicaixa');
            $table->dateTime('payment_date')->nullable();
            $table->string('status')->default('pago');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance');
    }
}
