<?php

namespace App\Http\Controllers\API;

use App\Contracts\PlayerRepositoryContract;
use App\Contracts\RoomRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\JoinRoomRequest;
use App\Http\Resources\PlayerResource;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class RoomController extends Controller
{

    public function __construct(
        readonly private RoomRepositoryContract $roomRepository,
        private readonly PlayerRepositoryContract $playerRepository
    )
    {
        /// Empty
    }

    public function create(): JsonResponse
    {
        $room = $this->roomRepository->create();
        return RoomResource::make($room)->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function join(Room $room, JoinRoomRequest $request): JsonResponse
    {
        // 1. Join the room
        $player = $this->playerRepository->join($room, $request->get('username'));

        // 2. Return response
        return PlayerResource::make($player)->response()->setStatusCode(Response::HTTP_OK);
    }

}
