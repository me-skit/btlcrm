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
            $table->string('hamlet', 128)->nullable();
            $table->string('colony', 128)->nullable();
            $table->string('alley', 64)->nullable();
            $table->string('zone', 2);
            $table->string('house_number', 8)->nullable();
            $table->string('phone_number', 16)->nullable();
            $table->decimal('longitude', 10, 6);
            $table->decimal('latitude', 10, 6);
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
