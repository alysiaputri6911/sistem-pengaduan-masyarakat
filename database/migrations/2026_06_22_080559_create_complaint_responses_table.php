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
    Schema::create('complaint_responses',
    function (Blueprint $table) {

        $table->id();

        $table->foreignId('complaint_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('responder_name');

        $table->string('responder_role')
              ->nullable();

        $table->text('message');

        $table->string('attachment')
              ->nullable();

        $table->boolean('is_final')
              ->default(false);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_responses');
    }
};
