<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowanceSalariesTable extends Migration
{
    public function up()
    {
        Schema::create('allowance_salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->string('type');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('allowance_amount', 10, 2);
            $table->decimal('total_salary', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('allowance_salaries');
    }
}
