<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('kendaraans', function (Blueprint $table) {
        $table->unsignedInteger('stok')->default(1)->after('status');
    });
}

public function down(): void
{
    Schema::table('kendaraans', function (Blueprint $table) {
        $table->dropColumn('stok');
    });
}

};
