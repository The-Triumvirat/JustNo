<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('no_reasons', function (Blueprint $table) {
            $table->string('reason', 512)->change();
        });
    }

    public function down(): void
    {
        Schema::table('no_reasons', function (Blueprint $table) {
            $table->string('reason', 500)->change();
        });
    }
};
