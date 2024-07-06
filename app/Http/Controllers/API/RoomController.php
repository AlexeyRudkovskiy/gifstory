<?php

namespace App\Http\Controllers\API;

use App\Contracts\RoomRepositoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoomController extends Controller
{

    public function __construct(readonly private RoomRepositoryContract $roomRepository)
    {

    }

    public function create(): JsonResponse
    {
        $room = $this->roomRepository->create();
        return response()->json($room, Response::HTTP_CREATED);
    }

}
