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
        Schema::create('question_room', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Room::class, 'room_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Question::class, 'question_id')
                ->constrained()
                ->onDelete('cascade');

            $table->primary([ 'room_id', 'question_id' ]);
            $table->unique([ 'room_id', 'question_id' ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_room');
    }
};
