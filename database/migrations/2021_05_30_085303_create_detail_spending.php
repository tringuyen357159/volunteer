<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSpending extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_spending', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('sponsor_id');
            $table->double('money');
            $table->timestamps();
        });

        Schema::table('detail_spending', function (Blueprint $table) {
            $table->foreign('event_id')
            ->references('id')
            ->on('event')
            ->onDelete('cascade');

            $table->foreign('sponsor_id')
            ->references('id')
            ->on('sponsors')
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
        Schema::dropIfExists('detail_spending');
    }
}
