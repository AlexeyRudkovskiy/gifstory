<?php

namespace App\Http\Controllers\API;

use App\Contracts\QuestionRepositoryContract;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Response;

class QuestionController extends Controller
{

    public function __construct(private readonly QuestionRepositoryContract $questionRepository)
    {

    }

    public function index(Room $room)
    {

        $question = $this->questionRepository->next($room);
        return response()->json([], Response::HTTP_OK);
    }

}
