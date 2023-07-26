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
        Schema::create('user_has_elements', function (Blueprint $table) {
            $table->id();
            $table->string('label', 45);
            $table->enum('type', ['Text', 'Select', 'Boolean']);
            $table->text('value');
            $table->foreignId('users_has_flow_id')->unsigned();
            $table->foreign('users_has_flow_id')->references('id')->on('users_has_flow')->onDelete('cascade');
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
        //
    }
};
