<?php

namespace App\Contracts;

use App\Exceptions\RoomNotFound;
use App\Models\Room;

interface RoomRepositoryContract
{

    public function create(): Room;

    /**
     * @param string $uuid
     * @return Room
     * @throws RoomNotFound
     */
    public function get(string $uuid): Room;

}
