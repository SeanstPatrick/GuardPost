<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('user_id')->on('businesses');
            $table->bigInteger('assigned_to')->nullable();
            $table->string('description');
            $table->double('rate', 8, 2);
            $table->string('street');
            $table->string('city');
            $table->string('prov');
            $table->string('postcode');
            $table->bigInteger('security_rating');
            $table->bigInteger('height');
            $table->bigInteger('weight');
            $table->bigInteger('female_guards');
            $table->bigInteger('male_guards');
            $table->bigInteger('status');
            $table->timestamp('start_date_time');
            $table->timestamp('end_date_time')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
