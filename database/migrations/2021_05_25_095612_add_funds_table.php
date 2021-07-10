<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email',255);
            $table->string('phone',255);
            $table->string('address',255);
            $table->double('fund',18,9);
            $table->enum('status',['public','hide']);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->enum('method', ['direct', 'card', 'bank']);
            $table->string('content');
        });
        Schema::table('funds', function (Blueprint $table) {
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
        Schema::table('funds', function (Blueprint $table) {
            //
        });
    }
}
