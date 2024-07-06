<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id UUID
 * @property Collection<Player> $players
 */
class Room extends Model
{
    use HasFactory, HasUuids;

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }
}
