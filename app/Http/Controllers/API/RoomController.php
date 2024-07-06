<?php

namespace App\Http\Controllers\API;

use App\Contracts\RoomRepositoryContract;
use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoomController extends Controller
{

    public function __construct(readonly private RoomRepositoryContract $roomRepository)
    {
        /// Empty
    }

    public function create(): JsonResponse
    {
        $room = $this->roomRepository->create();
        return response()->json($room, Response::HTTP_CREATED);
    }

}
