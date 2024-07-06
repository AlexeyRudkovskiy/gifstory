<?php

namespace App\Services;

use App\Contracts\QuestionRepositoryContract;
use App\Contracts\RoomRepositoryContract;
use App\Models\Player;
use App\Models\Question;
use App\Models\Room;

class QuestionRepository implements QuestionRepositoryContract
{

    public function __construct(private readonly RoomRepositoryContract $roomRepository)
    {

    }

    public function next(Room $room): ?Question
    {
        // 1. Fetch already played questions
        $playedQuestions = $this->roomRepository->getPlayedQuestionsIds($room);

        // 2. Get next question
        /** @var Question $nextQuestion */
        $question = Question::query()
            ->whereNotIn('id', $playedQuestions)
            ->inRandomOrder()
            ->first();

        if ($question === null) {
            return null;
        }

        // 3. Add new question to played list
        $this->roomRepository->addToPlayed($room, $question);

        return $question;
    }

    public function answer(Room $room, Player $player, string $answer): void
    {

    }

}
