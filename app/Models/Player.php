<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Room $room
 * @property int $points
 */
class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'points'
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

}
