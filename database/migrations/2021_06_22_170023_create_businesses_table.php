<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
			$table->foreignId('business_type_id');
			$table->foreignId('teacher_id');
			$table->foreignId('owner_id');
			$table->string('name');
			$table->string('slug', 191)->nullable()->unique();
			$table->longText('description');
			$table->string('logo')->nullable();
			$table->string('tagline');
			$table->string('invitation_code', 191)->nullable()->unique();
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
        Schema::dropIfExists('businesses');
    }
}
