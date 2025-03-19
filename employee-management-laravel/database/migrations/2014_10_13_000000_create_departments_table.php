<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique(); // Tên phòng ban, không trùng lặp
            $table->text('description')->nullable(); // Mô tả phòng ban
            $table->timestamps(); // Tạo cột created_at & updated_at
            $table->tinyInteger('deleted')->default(0); // Xác định phòng ban đã bị xóa chưa
        });
    }

    public function down() {
        Schema::dropIfExists('departments');
    }
};