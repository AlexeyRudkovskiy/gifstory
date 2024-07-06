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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();

            $table->string('url');

            $table->foreignIdFor(\App\Models\Room::class, 'room_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Question::class, 'question_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Player::class, 'player_id')
                ->constrained()
                ->onDelete('cascade');

            $table->unique([ 'room_id', 'question_id', 'player_id' ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
