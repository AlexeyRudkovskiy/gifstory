<?php

namespace App\Contracts;

use App\Models\Player;
use App\Models\Question;
use App\Models\Room;

interface QuestionRepositoryContract
{

    public function next(Room $room): ?Question;

}
