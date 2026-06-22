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
    Schema::create('complaints', function (Blueprint $table) {

        $table->id();

        $table->foreignId('user_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('complaint_code')->unique();

        $table->string('title');

        $table->text('description');

        $table->string('category')->nullable();

        $table->string('location')->nullable();

        $table->string('complainant_name');

        $table->string('phone');

        $table->string('email')->nullable();

        $table->enum('priority',[
            'low',
            'medium',
            'high',
            'critical'
        ])->default('medium');

        $table->enum('status',[
            'open',
            'in_review',
            'in_progress',
            'resolved',
            'closed'
        ])->default('open');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
