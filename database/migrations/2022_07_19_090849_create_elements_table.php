<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->string('label', 45);
            $table->string('type', 45);
            $table->text('value');
            $table->foreignId('steps_id');
            $table->foreign('steps_id')->references('id')->on('steps')->onDelete('cascade');
            $table->foreignId('elements_id');
            $table->foreign('elements_id')->references('id')->on('archivios')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elements');
    }
};
