<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verification_tokens', function (Blueprint $table) {
            $table->increments('id');

            $model = config('brandstudio.auth.model');
            $users_table = (new $model)->getTable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on($users_table)->onDelete('cascade');

            $table->string('login');
            $table->text('token');
            $table->string('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verification_tokens');
    }
}
