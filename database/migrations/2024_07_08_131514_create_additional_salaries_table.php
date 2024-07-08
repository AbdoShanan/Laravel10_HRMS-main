<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalSalariesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('additional_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->unique();
            $table->string('type');
            $table->decimal('basic_salary', 8, 2);
            $table->decimal('additional_amount', 8, 2);
            $table->decimal('total_amount', 8, 2);
            $table->timestamps();
            
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_salaries');
    }
}
