<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminstrationStaffDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     /* جدول بيانات موظفين الادارة */
    public function up()
    {
        Schema::create('adminstration_staff_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('department_name');
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
        Schema::dropIfExists('adminstration_staff_details');
    }
}
