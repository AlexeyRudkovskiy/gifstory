<?php

namespace App\Http\Controllers\API;

use App\Contracts\AnswerRepositoryContract;
use App\Contracts\GameContract;
use App\Contracts\QuestionRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class QuestionController extends Controller
{

    public function __construct(
        private readonly QuestionRepositoryContract $questionRepository,
        private readonly AnswerRepositoryContract $answerRepository,
        private readonly GameContract $gameContract
    )
    {
        /// Empty
    }

    public function nextQuestion(Room $room): JsonResponse
    {
        $question = $this->questionRepository->next($room);

        // If no more questions - return an error
        if ($question === null) {
            return response()->json([
                'message' => __('No more questions :(')
            ], Response::HTTP_NO_CONTENT);
        }

        return QuestionResource::make($question)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function answers(Room $room, Question $question): JsonResponse
    {
        // 1. Get all answers
        $answers = $this->answerRepository->findForQuestion($room,  $question);

        // 2. Return answers
        return response()->json($answers);
    }

    public function answer(): void
    {

    }

}
