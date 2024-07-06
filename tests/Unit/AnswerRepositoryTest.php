<?php

namespace Tests\Unit;

use App\Contracts\AnswerRepositoryContract;
use App\Contracts\PlayerRepositoryContract;
use App\Contracts\QuestionRepositoryContract;
use App\Contracts\RoomRepositoryContract;
use App\Exceptions\AnswerAlreadyProvided;
use App\Models\Player;
use App\Models\Question;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnswerRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected const MAX_QUESTIONS_IN_TEST = 2;

    private readonly AnswerRepositoryContract $answerRepository;
    private readonly RoomRepositoryContract $roomRepository;
    private readonly PlayerRepositoryContract $playerRepository;
    private readonly QuestionRepositoryContract $questionRepository;
    private readonly Room $room;
    private readonly Player $player;

    public function setUp(): void
    {
        parent::setUp();

        $this->answerRepository = app()->make(AnswerRepositoryContract::class);
        $this->roomRepository = app()->make(RoomRepositoryContract::class);
        $this->playerRepository = app()->make(PlayerRepositoryContract::class);
        $this->questionRepository = app()->make(QuestionRepositoryContract::class);

        $this->room = $this->roomRepository->create();
        $this->player = $this->playerRepository->join($this->room, 'player');

        Question::factory()->count(self::MAX_QUESTIONS_IN_TEST)->create();
    }

    public function test_create_new_answer()
    {
        // 1. Get question
        $question = $this->questionRepository->next($this->room);

        // 2. Add answer
        $this->answerRepository->create($this->room, $question, $this->player, 'test-url');

        // 3. Check database changes
        $this->assertDatabaseCount('answers', 1);
        $this->assertDatabaseHas('answers', [
            'url' => 'test-url',
            'room_id' => $this->room->id,
            'player_id' => $this->player->id,
            'question_id' => $question->id,
        ]);
    }

    public function test_create_multiple_answers_by_one_user()
    {
        // 1. Get question
        $question = $this->questionRepository->next($this->room);

        // 2. Add first answer
        $this->answerRepository->create($this->room, $question, $this->player, 'answer-1');

        // 3. Expect an exception
        $this->expectException(AnswerAlreadyProvided::class);

        // 4. Add second answer
        $this->answerRepository->create($this->room, $question, $this->player, 'answer-2');
    }

    public function test_return_answers()
    {
        // 1. Add second player
        $secondPlayer = $this->playerRepository->join($this->room, 'player-2');

        // 2. Get next question
        $question = $this->questionRepository->next($this->room);

        // 3. Add first answer
        $firstAnswer = $this->answerRepository->create($this->room, $question, $this->player, 'answer-1');

        // 4. Add second answer
        $secondAnswer = $this->answerRepository->create($this->room, $question, $secondPlayer, 'answer-2');

        // 5. Get all answers
        $answers = $this->answerRepository->findForQuestion($this->room, $question);

        // 6. Assert collection
        $this->assertEquals(2, $answers->count());
        $this->assertTrue($answers->contains($firstAnswer));
        $this->assertTrue($answers->contains($secondAnswer));
    }

    public function test_find_answers_should_return_only_answers_for_provided_question()
    {
        // 1. Add second player
        $secondPlayer = $this->playerRepository->join($this->room, 'player-2');

        // 2. Get next question
        $question = $this->questionRepository->next($this->room);

        // 3. Add first answer
        $firstAnswer = $this->answerRepository->create($this->room, $question, $this->player, 'answer-1');

        // 4. Add second answer
        $secondAnswer = $this->answerRepository->create($this->room, $question, $secondPlayer, 'answer-2');

        // 5. Get second question
        $secondQuestion = $this->questionRepository->next($this->room);

        // 6. Add answer to second question
        $thirdAnswer = $this->answerRepository->create($this->room, $secondQuestion, $this->player, 'answer-3');

        // 7. Get all answers
        $answers = $this->answerRepository->findForQuestion($this->room, $question);

        // 8. Assert collection
        $this->assertEquals(2, $answers->count());
        $this->assertTrue($answers->contains($firstAnswer));
        $this->assertTrue($answers->contains($secondAnswer));
        $this->assertFalse($answers->contains($thirdAnswer));
    }

}
