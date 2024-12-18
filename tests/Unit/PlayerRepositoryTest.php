<?php

namespace Tests\Unit;

use App\Contracts\PlayerRepositoryContract;
use App\Contracts\RoomRepositoryContract;
use App\Exceptions\PlayerAlreadyExists;
use App\Exceptions\PlayerNotExists;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlayerRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private readonly PlayerRepositoryContract $playerRepository;
    private readonly RoomRepositoryContract $roomRepository;
    private readonly Room $room;

    public function setUp(): void
    {
        parent::setUp();

        $this->playerRepository = app()->make(PlayerRepositoryContract::class);
        $this->roomRepository = app()->make(RoomRepositoryContract::class);
        $this->room = $this->roomRepository->create();
    }

    public function test_join_existing_room()
    {
        // 1. Try to join the room
        $this->playerRepository->join($this->room, 'username');

        // 2. Verify that table has record
        $this->assertDatabaseCount('players', 1);
        $this->assertDatabaseHas('players', [
            'username' => 'username',
            'room_id' => $this->room->id
        ]);
    }

    public function test_join_multiple_players()
    {
        // 1. Join first player
        $this->playerRepository->join($this->room, 'player-1');

        // 2. Join second player
        $this->playerRepository->join($this->room, 'player-2');

        // 3. Verify that table has records
        $this->assertDatabaseCount('players', 2);

        // 4. Verify that room has players
        $playersCount = $this->room->players()->count();
        $this->assertEquals(2, $playersCount);
    }

    public function test_join_with_taken_username()
    {
        // 1. Join first player
        $this->playerRepository->join($this->room, 'username');

        // 2. Expect exception
        $this->expectException(PlayerAlreadyExists::class);

        // 3. Join second player
        $this->playerRepository->join($this->room, 'username');
    }

    public function test_it_should_find_player_by_token()
    {
        // 1. Join the room
        $originalPlayer = $this->playerRepository->join($this->room, 'username');

        // 2. Find player by token
        $player = $this->playerRepository->findByToken($originalPlayer->token);

        // 3. Assert player
        $this->assertEquals($originalPlayer->token, $player->token);
    }

    public function test_it_should_throw_an_exception_when_token_not_exists()
    {
        // 1. Expect exception
        $this->expectException(PlayerNotExists::class);

        // 2. Try to find a player
        $this->playerRepository->findByToken('invalid');
    }

}
