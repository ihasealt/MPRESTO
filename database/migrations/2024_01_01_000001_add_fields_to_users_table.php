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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim')->nullable()->unique()->after('name');
            $table->string('role')->default('mahasiswa')->after('email'); // 'mahasiswa' atau 'admin'
            $table->string('prodi')->nullable()->default('Sistem Informasi')->after('role');
            $table->string('avatar')->nullable()->after('prodi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nim', 'role', 'prodi', 'avatar']);
        });
    }
};
