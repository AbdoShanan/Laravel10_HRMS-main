<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeExtensionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_extension_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contracting_id');
            $table->foreign('contracting_id')->references('id')->on('contractings')->onDelete('cascade');
            $table->integer('extra_time'); 
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
        Schema::dropIfExists('time_extension_details');
    }
}
