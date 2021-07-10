<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('summary');
            $table->string('content');
            $table->text('photo');
            $table->float('budget_estimates');
            $table->integer('number_of_participants');
            $table->integer('real_quantity');
            $table->dateTime('start_day');
            $table->dateTime('end_day');
            $table->enum('type', ['môi trường', 'thể thao', 'quyên tặng']);
            $table->string('location');
            $table->string('status');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
}
