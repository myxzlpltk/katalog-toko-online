<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id');
            $table->foreignId('student_id');
            $table->enum('role', ['owner', 'member']);
            $table->boolean('is_valid')->default(false);
            $table->timestamp('validated_at')->nullable();
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
        Schema::dropIfExists('business_student');
    }
}
