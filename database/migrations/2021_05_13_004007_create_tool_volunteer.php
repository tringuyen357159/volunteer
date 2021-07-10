<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolVolunteer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_volunteer', function (Blueprint $table) {
            $table->id();
            $table->string('name_volunteer', 255);
            $table->string('name_tool', 255);
            $table->integer('quanlity');
            $table->unsignedBigInteger('tool_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('tool_volunteer', function (Blueprint $table) {
            $table->foreign('tool_id')
            ->references('id')
            ->on('tools')
            ->onDelete('cascade');

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
        Schema::dropIfExists('tool_volunteer');
    }
}
