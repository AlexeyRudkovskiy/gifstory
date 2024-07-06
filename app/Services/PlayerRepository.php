<?php

namespace App\Services;

use App\Contracts\PlayerRepositoryContract;
use App\Contracts\RoomRepositoryContract;
use App\Exceptions\PlayerAlreadyExists;
use App\Models\Player;
use App\Models\Room;

class PlayerRepository implements PlayerRepositoryContract
{

    public function __construct(private readonly RoomRepositoryContract $roomRepository)
    {}

    public function join(Room $room, string $username): Player
    {

        // 1. Check is username is not taken
        $playersWithSameUsername = $this->roomRepository->hasPlayer($room, $username);
        if ($playersWithSameUsername) {
            throw new PlayerAlreadyExists('Player with username ' . $username . ' already exist in this room');
        }

        // 2. Add player to the room
        $player = $this->roomRepository->addPlayer($room, $username);

        return $player;
    }

}
