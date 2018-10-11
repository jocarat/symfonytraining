<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 10/10/2018
 * Time: 16:12
 */

namespace App\Tests\Game;


use App\Game\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{

    public function testConstructWithDefaultBehaviour()
    {
        $game = new Game('airplane');

        $this->assertAttributeSame('airplane', 'word', $game);
        $this->assertAttributeSame(0, 'attempts', $game);
        $this->assertAttributeSame([], 'triedLetters', $game);
        $this->assertAttributeSame([], 'foundLetters', $game);
    }

    public function testConstructNormalizesTheWord()
    {
        $game_word = 'AirPlane';
        $game = new Game($game_word);

        $this->assertAttributeSame(strtolower($game_word), 'word', $game);
    }

    public function testGetRemainingAttempts()
    {
        $game = new Game('airplane');

        $this->assertSame($game::MAX_ATTEMPTS, $game->getRemainingAttempts());
    }

    public function testTryLetter()
    {
        $game = new Game('airplane');

        $this->assertTrue($game->tryLetter('a'));
        $this->assertFalse($game->tryLetter('b'));
    }

    /**
     * @dataProvider provideWords
     */
    public function testTryWord(string $game_word, string $tried_word, bool $value)
    {
        $game = new Game($game_word);

        $this->assertSame($value, $game->tryWord($tried_word));
    }

    public function provideWords()
    {
        yield['airplane', 'AirPlane', true];
        yield['airplane', 'airplane', true];
        yield['airplane', 'banana', false];
    }
}