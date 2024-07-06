<?php

namespace App\Contracts;

use App\Exceptions\AnswerAlreadyProvided;
use App\Models\Answer;
use App\Models\Player;
use App\Models\Question;
use App\Models\Room;
use Illuminate\Support\Collection;

interface AnswerRepositoryContract
{

    /**
     * Create new answer
     *
     * @param Room $room
     * @param Question $question
     * @param Player $player
     * @param string $url
     * @return Answer
     * @throws AnswerAlreadyProvided If answer already provided by this player for this pair of room and question
     */
    public function create(Room $room, Question $question, Player $player, string $url): Answer;

    /**
     * Find all answers for specific question
     *
     * @param Room $room
     * @param Question $question
     * @return Collection
     */
    public function findForQuestion(Room $room, Question $question): Collection;

}
