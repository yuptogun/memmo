<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->string('configurable_type');
            $table->unsignedBigInteger('configurable_id');
            $table->string('key');
            $table->string('value');

            $table->unique(['configurable_type', 'configurable_id', 'key']);
        });
    }

    public function down(): void
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->dropUnique(['configurable_type', 'configurable_id', 'key']);
        });
        Schema::dropIfExists('configs');
    }
};
