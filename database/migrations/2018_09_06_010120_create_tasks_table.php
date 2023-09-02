<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('command');
            $table->string('expression')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('dont_overlap')->default(false);
            $table->boolean('run_in_maintenance')->default(false);
            $table->string('notification_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
