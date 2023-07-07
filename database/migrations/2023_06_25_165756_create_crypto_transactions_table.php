<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('crypto_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id');
            $table->integer('crypto_id');
            $table->string('cryptocurrency');
            $table->string('currency');
            $table->float('price');
            $table->float('invest');
            $table->float('crypto_parts', 12, 4);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crypto_transactions');
    }
}
