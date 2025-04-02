<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('object')->nullable();
            $table->string('module')->nullable();
            $table->integer('module_id')->nullable();
            $table->text('contenu')->nullable(); 

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');

            $table->unsignedBigInteger('creator_id')->nullable();
            $table->foreign('creator_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');

            $table->string('link')->nullable();
            $table->string('etat')->nullable();
            $table->datetime('read_at')->nullable();
            $table->boolean('system')->default(true);
            $table->string('key')->nullable();
            $table->datetime('start_at')->default(DB::raw('NOW()'));

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
