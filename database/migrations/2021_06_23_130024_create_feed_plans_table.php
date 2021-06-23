<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id');
            $table->unsignedInteger('feed_index');
            $table->dateTime('plan_date');
            $table->string('topic');
            $table->text('content');
            $table->string('brief_image');
            $table->text('caption');
            $table->text('headline');
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
        Schema::dropIfExists('feed_plans');
    }
}
