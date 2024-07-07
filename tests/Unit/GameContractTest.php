<?php

namespace Tests\Unit;

use App\Contracts\GameContract;
use App\Contracts\PlayerRepositoryContract;
use App\Contracts\RoomRepositoryContract;
use App\Models\Player;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameContractTest extends TestCase
{
    use RefreshDatabase;

    private readonly RoomRepositoryContract $roomRepository;
    private readonly PlayerRepositoryContract $playerRepository;
    private readonly GameContract $gameContract;
    private readonly Room $room;
    private readonly Player $player;

    public function setUp(): void
    {
        parent::setUp();

        $this->gameContract = app()->make(GameContract::class);
        $this->roomRepository = app()->make(RoomRepositoryContract::class);
        $this->playerRepository = app()->make(PlayerRepositoryContract::class);
        $this->room = $this->roomRepository->create();
        $this->player = $this->playerRepository->join($this->room, 'username');
    }

    public function test_it_should_store_player()
    {
        // 1. Set player
        $this->gameContract->setPlayer($this->player);

        // 2. Get player
        $storedPlayer = $this->gameContract->getPlayer();

        // 3. Assert values
        $this->assertEquals($this->player->id, $storedPlayer->id);
    }

    public function test_it_should_store_room()
    {
        // 1. Set room
        $this->gameContract->setRoom($this->room);

        // 2. Get room
        $storedRoom = $this->gameContract->getRoom();

        // 3. Assert values
        $this->assertEquals($this->room->id, $storedRoom->id);
    }

    public function test_it_should_set_room_based_on_player()
    {
        // 1. Set player
        $this->gameContract->setPlayer($this->player);

        // 2. Get room
        $storedRoom = $this->gameContract->getRoom();

        // 3. Assert values
        $this->assertEquals($this->room->id, $storedRoom->id);

    }

}
