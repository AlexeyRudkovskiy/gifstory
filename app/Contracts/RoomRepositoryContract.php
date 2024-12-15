<?php

namespace App\Contracts;

use App\Exceptions\PlayerAlreadyExists;
use App\Exceptions\RoomNotFound;
use App\Models\Player;
use App\Models\Question;
use App\Models\Room;
use Illuminate\Support\Collection;

interface RoomRepositoryContract
{

    /**
     * Return my rooms
     *
     * @return Collection<Room>
     */
    public function getMyRooms(): Collection;

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

    /**
     * Returns true/false depends on if player with ``$username`` already joined the room
     *
     * @param Room $room
     * @param string $username
     * @return bool
     */
    public function hasPlayer(Room $room, string $username): bool;

    /**
     * Add new player to the room
     *
     * @param Room $room
     * @param string $username Player's username
     * @return void
     */
    public function addPlayer(Room $room, string $username): Player;

    /**
     * Add question to collection of already played questions
     *
     * @param Room $room
     * @param Question $question
     * @return void
     */
    public function addToPlayed(Room $room, Question $question): void;

    /**
     * Returns collection of already played questions
     *
     * @param Room $room
     * @return Collection
     */
    public function getPlayedQuestionsIds(Room $room): Collection;

}
