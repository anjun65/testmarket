<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_addresses', function (Blueprint $table) {
            $table->id();
            
            $table->integer('users_id');
            $table->string('address1');
            $table->string('address2');
            $table->string('province');
            $table->string('city');
            $table->string('zip');
            $table->string('country');
            $table->string('mobile');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_address');
    }
}
