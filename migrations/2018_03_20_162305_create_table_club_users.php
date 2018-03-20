<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClubUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',1000);
            $table->string('slug',900)->unique();
            $table->string('score',20);
            $table->text('description');
            $table->tinyInteger('status')->default(0);
            $table->jsonb('data');
            $table->timestamp('created_at');
        });

        Schema::create('action_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->string('action_id');
            $table->integer('score')->default(0);
            $table->text('description');
            $table->jsonb('data');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('actions');
        Schema::drop('action_user');
    }
}
