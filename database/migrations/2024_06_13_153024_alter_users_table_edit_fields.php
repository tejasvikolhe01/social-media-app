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
            $table->dropColumn('name');
            $table->string('first_name',255)->after('id');
            $table->string('last_name',255)->after('first_name')->nullable();
            $table->string('username',255)->after('last_name')->unique();
            $table->date('dob')->after('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('name', 255)->after('id');
            $table->dropColumn([
                'first_name',
                'last_name',
                // 'username',
                // 'dob',
            ]);
        });
    }
};
