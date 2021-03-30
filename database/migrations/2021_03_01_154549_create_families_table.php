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
            $table->foreignId('village_id')->constrained();
            $table->tinyInteger('union_type');
            $table->string("family_name", 128);
            $table->string('address');
            $table->string('phone_number', 16)->nullable();
            $table->boolean('active')->default(1);
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
