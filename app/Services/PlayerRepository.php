<?php

namespace App\Services;

use App\Contracts\PlayerRepositoryContract;
use App\Exceptions\PlayerAlreadyExists;
use App\Models\Player;
use App\Models\Room;

class PlayerRepository implements PlayerRepositoryContract
{

    public function join(Room $room, string $username): Player
    {
        // 1. Check is username is not taken
        $playersWithSameUsername = $room->players()->where('username', $username)->exists();
        if ($playersWithSameUsername) {
            throw new PlayerAlreadyExists('Player with username ' . $username . ' already exist in this room');
        }

        // 2. Add player to the room
        /** @var Player $player */
        $player = $room->players()->create([
            'username' => $username,
            'points' => 0
        ]);

        return $player;
    }

}
