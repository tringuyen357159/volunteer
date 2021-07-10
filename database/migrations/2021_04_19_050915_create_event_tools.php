<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('event_tool', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name_event', 255);
        //     $table->string('name_tool', 255);
        //     $table->unsignedBigInteger('event_id');
        //     $table->unsignedBigInteger('tool_id');
        //     $table->timestamps();
        // });

        // Schema::table('event_tool', function (Blueprint $table) {
        //     $table->foreign('event_id')
        //     ->references('id')
        //     ->on('event')
        //     ->onDelete('cascade');

        //     $table->foreign('tool_id')
        //     ->references('id')
        //     ->on('tools')
        //     ->onDelete('cascade');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_tools');
    }
}
