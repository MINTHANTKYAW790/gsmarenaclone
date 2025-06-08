<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('heading');
            $table->string('image_1')->nullable();
            $table->text('paragraph_1')->nullable();
            $table->string('image_2')->nullable();
            $table->text('paragraph_2')->nullable();

            $table->tinyInteger('rating')->unsigned()->nullable();

            $table->string('logo1')->nullable();
            $table->text('link1')->nullable();

            $table->string('logo2')->nullable();
            $table->text('link2')->nullable();

            $table->string('logo3')->nullable();
            $table->text('link3')->nullable();
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
        Schema::dropIfExists('reviews');
    }
};
