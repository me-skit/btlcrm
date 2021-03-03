<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('union_type_id')->constrained();
            $table->foreignId('village_id')->constrained();
            $table->tinyInteger('av_st_number')->nullable();
            $table->tinyInteger('is_st_av')->default('0');
            $table->string('house_number', 8)->nullable();
            $table->tinyInteger('zone')->nullable();
            $table->string('addr_extra_info')->nullable();
            $table->string('phone_number', 16)->nullable();
            $table->decimal('longitude', 19, 14)->nullable();
            $table->decimal('latitude', 19, 14)->nullable();
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
        Schema::dropIfExists('families');
    }
}
