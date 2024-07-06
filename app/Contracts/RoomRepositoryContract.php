<?php

namespace App\Contracts;

use App\Exceptions\PlayerAlreadyExists;
use App\Exceptions\RoomNotFound;
use App\Models\Player;
use App\Models\Room;

interface RoomRepositoryContract
{

    /**
     * Create new room and return it
     *
     * @return Room
     */
    public function create(): Room;

    /**
     * Find existing room or throws exception if room not exist
     *
     * @param string $uuid
     * @return Room
     * @throws RoomNotFound
     */
    public function get(string $uuid): Room;

}
