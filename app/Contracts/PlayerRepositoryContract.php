<?php

namespace App\Contracts;

use App\Exceptions\PlayerAlreadyExists;
use App\Exceptions\PlayerNotExists;
use App\Exceptions\RoomNotFound;
use App\Models\Player;
use App\Models\Room;

interface PlayerRepositoryContract
{

    /**
     * Add player to the room or throws exception if username has already been taken
     *
     * @param Room $room
     * @param string $username
     * @return Player
     * @throws PlayerAlreadyExists
     */
    public function join(Room $room, string $username): Player;

    /**
     * @param string $token
     * @return Player|null
     * @throws PlayerNotExists
     */
    public function findByToken(string $token): ?Player;

}
