<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('investment_accounts', function (Blueprint $table) {
            $table->integer('id');
            $table->foreignId('user_id');
            $table->string('title');
            $table->string('number')->unique();
            $table->string('bank');
            $table->string('currency');
            $table->decimal('deposit');
            $table->decimal('balance');
            $table->decimal('withdrawal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('investment_accounts');
    }
}
