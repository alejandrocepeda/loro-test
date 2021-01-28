<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('first_name',50)->nullable(false);
            $table->string('last_name',50)->nullable(false);
            $table->integer('identification')->nullable(false);
            $table->integer('state_id')->nullable(false);
            $table->integer('city_id')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->string('mail')->nullable(false);
            $table->boolean('habeas_data')->default(false);
            $table->boolean('winner')->default(false);
            $table->boolean('notification_success')->default(false);
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
        Schema::dropIfExists('customers');
    }
}
