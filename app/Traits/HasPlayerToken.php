<?php

namespace App\Traits;

use App\Models\Player;
use Illuminate\Support\Str;

/**
 * Generate and set token with unique UUID
 */
trait HasPlayerToken
{

    public static function bootHasPlayerToken()
    {
        self::creating(fn (Player $player) => $player->token = Str::uuid()->toString());
    }

}
