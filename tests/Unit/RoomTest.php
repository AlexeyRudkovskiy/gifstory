<?php

namespace Tests\Unit;

use App\Exceptions\RoomNotFound;
use Tests\TestCase;
use App\Contracts\RoomRepositoryContract;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    private readonly RoomRepositoryContract $roomRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->roomRepository = app()->make(RoomRepositoryContract::class);
    }

    public function test_create_new_room(): void
    {
        // 1. Create new room
        $this->roomRepository->create();

        // 2. Check rooms count in the database
        $this->assertDatabaseCount('rooms', 1);
    }

    public function test_find_room(): void
    {
        // 1. Create new room
        $createdRoom = $this->roomRepository->create();

        // 2. Get the record from database
        $room = $this->roomRepository->get($createdRoom->id);

        // 3. Verify
        $this->assertEquals($createdRoom->id, $room->id);
    }

    public function test_find_room_not_found()
    {
        // 1. Expect exception
        $this->expectException(RoomNotFound::class);

        // 2. Get the record from database
        $this->roomRepository->get('room-id');
    }

}
