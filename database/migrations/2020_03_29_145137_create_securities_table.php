<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecuritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('securities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('gender');
            $table->string('phone');
            $table->string('emergency_phone');
            $table->smallInteger('rating');
            $table->smallInteger('cpr');
            $table->smallInteger('height');
            $table->smallInteger('weight');
            $table->bigInteger('license_number')->unique();
            $table->string('license_type');
            $table->timestamp('license_expire');
            $table->string('jurisdiction');
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
        Schema::dropIfExists('securities');
    }
}
