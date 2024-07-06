<?php

namespace App\Http\Controllers\API;

use App\Contracts\PlayerRepositoryContract;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlayerController extends Controller
{

    public function __construct(private readonly PlayerRepositoryContract $playerRepository)
    {
        /// Empty
    }

    public function join(Room $room, Request $request)
    {
        return response()->json([
            'player' => $this->playerRepository->join($room, $request->get('username'))
        ], Response::HTTP_OK);
    }

}
