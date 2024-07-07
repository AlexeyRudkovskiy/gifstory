<?php

namespace App\Models;

use App\Traits\HasPlayerToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Room $room
 * @property int $points
 * @property string $token
 */
class Player extends Model
{
    use HasFactory, HasPlayerToken;

    protected $fillable = [
        'username', 'points', 'token'
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

}
