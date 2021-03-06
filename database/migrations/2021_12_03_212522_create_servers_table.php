<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('box_id')->constrained()->cascadeOnDelete();
            $table->string('label')->nullable();
            $table->string('root')->nullable();
            $table->string('version')->nullable();
            $table->unsignedInteger('size')->nullable();
            $table->string('motd')->nullable();
            $table->string('gamemode')->nullable();
            $table->string('level_name')->nullable();
            $table->string('difficulty')->nullable();
            $table->unsignedInteger('server_port')->nullable();
            $table->boolean('hardcore')->default(false);
            $table->timestamp('last_played_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
