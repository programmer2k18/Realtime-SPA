<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('questions')) {
            Schema::create('questions', function (Blueprint $table) {

                $table->Increments('id');
                $table->string('title');
                $table->string('slug');
                $table->text('body');

                $table->integer('user_id')->unsigned();
                $table->integer('category_id')->unsigned();

                $table->foreign('user_id')->references('id')
                    ->on('users')->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->foreign('category_id')->references('id')
                    ->on('categories')->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->timestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
