<?php

namespace App\Services;

use App\Contracts\RoomRepositoryContract;
use App\Exceptions\PlayerAlreadyExists;
use App\Exceptions\RoomNotFound;
use App\Models\Player;
use App\Models\Room;

class RoomRepository implements RoomRepositoryContract
{

    public function create(): Room
    {
        $room = Room::create();
        return $room;
    }

    public function get(string $uuid): Room
    {
        $room = Room::find($uuid);

        if ($room === null) {
            throw new RoomNotFound('Room with id ' . $uuid . ' is not exist');
        }

        return $room;
    }

}
