<?php

namespace App\Contracts;

use App\Models\Player;
use App\Models\Room;

interface GameContract
{

    /**
     * Set the current game's room
     *
     * @param Room $room
     * @return GameContract
     */
    public function setRoom(Room $room): GameContract;

    /**
     * Get the current game's room
     *
     * @return Room
     */
    public function getRoom(): Room;

    /**
     * Set the current game's player
     *
     * @param Player $player
     * @return GameContract
     */
    public function setPlayer(Player $player): GameContract;

    /**
     * Get the current game's player
     *
     * @return Player
     */
    public function getPlayer(): Player;

}
