<?php

namespace Tests\Unit;

use App\Contracts\QuestionRepositoryContract;
use App\Contracts\RoomRepositoryContract;
use App\Models\Question;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionRepositoryTest extends TestCase
{

    use RefreshDatabase;

    protected const MAX_TEST_QUESTIONS = 5;

    private readonly QuestionRepositoryContract $questionRepository;
    private readonly RoomRepositoryContract $roomRepository;
    private readonly Room $room;

    public function setUp(): void
    {
        parent::setUp();

        $this->questionRepository = app()->make(QuestionRepositoryContract::class);
        $this->roomRepository = app()->make(RoomRepositoryContract::class);
        $this->room = $this->roomRepository->create();

        Question::factory()->count(self::MAX_TEST_QUESTIONS)->create();
    }

    public function test_get_next_question()
    {
        // 1. Fetch next question
        $question = $this->questionRepository->next($this->room);

        // 2. Verify next question is returned
        $this->assertNotNull($question);

        // 3. Verify question marked as played
        $this->assertDatabaseHas('question_room', [
            'question_id' => $question->id,
            'room_id' => $this->room->id
        ]);
    }

    public function test_no_more_questions()
    {
        // 1. Get all created questions (N questions)
        for ($i = 0; $i < self::MAX_TEST_QUESTIONS; $i++) {
            $this->questionRepository->next($this->room);
        }

        // 2. Get N + 1 question
        $question = $this->questionRepository->next($this->room);

        // 3. Assert
        $this->assertNull($question);
    }

}
