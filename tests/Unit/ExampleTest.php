<?php

namespace Tests\Unit;

use App\Score;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
	use RefreshDatabase;

    /**
     * A basic test 
     *
     * @return void
     */
    public function testBasicTest()
    {
        // Given i have 1 score today
        $daily = factory(Score::class)->create([
        	'created_at' => \Carbon\Carbon::now()
        ]);

        $weekly = factory(Score::class)->create([
        	'created_at' => \Carbon\Carbon::now()->subDays(7)
        ]);

        $monthly = factory(Score::class)->create([
        	'created_at' => \Carbon\Carbon::now()->month
        ]);

        $yearly = factory(Score::class)->create([
        	'created_at' => \Carbon\Carbon::now()->year
        ]);

        // dd($weekly);

        // When I fetch the scores
        $scores = Score::highscores();

        // Then the response should be in the proper format
        $this->get('/highscores?date=daily')
        	->assertSee($daily->user->name)
        	->assertDontSee($weekly->user->name)
        	->assertDontSee($monthly->user->name)
        	->assertDontSee($yearly->user->name);

        $this->get('/highscores?date=weekly')
        	->assertSee($daily->user->name)
        	->assertSee($weekly->user->name)
        	->assertDontSee($monthly->user->name)
        	->assertDontSee($yearly->user->name);


    }

    /**
     * A basic test 
     *
     * @return void
     */
    // public function testBasicTest()
    // {
    //     // Given i have 1 score today
    //     $weekly = factory(Score::class)->create([
    //     	'created_at' => \Carbon\Carbon::now()->addDays(7)
    //     ]);

    //     // When I fetch the scores
    //     $scores = Score::highscores();

    //     // Then the response should be in the proper format
    //     $this->get('/highscores?date=weekly')
    //     	->assertSee($weekly->user->name);
    // }

    /**
     * A basic test 
     *
     * @return void
     */
    // public function testBasicTest()
    // {
    //     // Given i have 1 score today
    //     $monthly = factory(Score::class)->create([
    //     	'created_at' => \Carbon\Carbon::now()->month
    //     ]);

    //     // When I fetch the scores
    //     $scores = Score::highscores();

    //     // Then the response should be in the proper format
    //     $this->get('/highscores?date=weekly')
    //     	->assertSee($monthly->user->name);
    // }
}
