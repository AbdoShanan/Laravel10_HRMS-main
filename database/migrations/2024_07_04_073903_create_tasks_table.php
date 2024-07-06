<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('title');
            $table->text('description');
            $table->time('timer')->default('00:00:00');
            $table->enum('status', ['open', 'pending', 'closed'])->default('open'); 
            $table->unsignedTinyInteger('review')->nullable(); 
            $table->timestamps();
        
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
