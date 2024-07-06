<?php

namespace App\Services;

use App\Contracts\RoomRepositoryContract;
use App\Exceptions\PlayerAlreadyExists;
use App\Exceptions\RoomNotFound;
use App\Models\Player;
use App\Models\Question;
use App\Models\Room;
use Illuminate\Support\Collection;

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

    public function hasPlayer(Room $room, string $username): bool
    {
        return $room->players()->where('username', $username)->exists();
    }

    public function addPlayer(Room $room, string $username): Player
    {
        $player = $room->players()->create([
            'username' => $username,
            'points' => 0
        ]);

        return $player;
    }


    public function addToPlayed(Room $room, Question $question): void
    {
        $room->questions()->attach($question->id);
    }

    public function getPlayedQuestionsIds(Room $room): Collection
    {
        return $room->questions()->pluck('id');
    }

}
