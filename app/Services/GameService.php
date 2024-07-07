<?php

namespace App\Services;

use App\Contracts\GameContract;
use App\Models\Player;
use App\Models\Room;

class GameService implements GameContract
{

    protected Room $room;

    protected Player $player;

    public function setRoom(Room $room): GameContract
    {
        $this->room = $room;
        return $this;
    }

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function setPlayer(Player $player): GameContract
    {
        $this->player = $player;

        $this->setRoom($player->room);

        return $this;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }
}
