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
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            $table->string('username');
            $table->smallInteger('points', unsigned: true)->default(0);
            $table->foreignIdFor(\App\Models\Room::class, 'room_id')
                ->constrained()
                ->onDelete('cascade');

            $table->unique(['username', 'room_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
