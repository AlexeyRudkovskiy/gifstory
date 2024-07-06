<?php

namespace App\Services;

use App\Contracts\AnswerRepositoryContract;
use App\Exceptions\AnswerAlreadyProvided;
use App\Models\Answer;
use App\Models\Player;
use App\Models\Question;
use App\Models\Room;
use Illuminate\Support\Collection;

class AnswerRepository implements AnswerRepositoryContract
{

    public function create(Room $room, Question $question, Player $player, string $url): Answer
    {
        // 1. Verify that answer is not provided yet
        $isAnswerExist = Answer::query()
            ->where('room_id', $room->id)
            ->where('question_id', $question->id)
            ->where('player_id', $player->id)
            ->exists();

        // 2. Throw exception if answer already provided
        if ($isAnswerExist) {
            throw new AnswerAlreadyProvided();
        }

        // 3. Create new answer
        $answer = Answer::create([
            'url' => $url,
            'room_id' => $room->id,
            'question_id' => $question->id,
            'player_id' => $player->id
        ]);

        return $answer;
    }

    public function findForQuestion(Room $room, Question $question): Collection
    {
        return Answer::query()
            ->where('room_id', $room->id)
            ->where('question_id', $question->id)
            ->latest()
            ->get();
    }
}
