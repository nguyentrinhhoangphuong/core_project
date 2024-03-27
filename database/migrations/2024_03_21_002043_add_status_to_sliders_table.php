<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('active'); // Thêm cột status với ENUM chỉ cho phép 'active' hoặc 'inactive'
        });
    }

    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('status'); // Xóa cột status nếu cần revert migration
        });
    }
};
