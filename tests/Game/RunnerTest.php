<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 10/10/2018
 * Time: 17:08
 */

namespace App\Tests\Game;


use App\Game\Game;
use App\Game\Runner;
use App\Game\Storage;
use App\Game\WordList;
use PHPUnit\Framework\TestCase;

class RunnerTest extends TestCase
{
    public function testConstruct()
    {
        $storage = $this->createMock(Storage::class);
        $wordList = $this->createMock(WordList::class);

        $runner = new Runner($storage, $wordList);

        $this->assertAttributeSame($storage, 'storage', $runner);
        $this->assertAttributeSame($wordList, 'wordList', $runner);
    }

    public function testLoadGameReturnsNewGameWhenStorageHasNoGame()
    {
        $storage = $this->createMock(Storage::class);
        $wordList = $this->createMock(WordList::class);

        $runner = new Runner($storage, $wordList);

        $wordList
            ->expects($this->once())
            ->method('getRandomWord');

        $game = $this->createMock(Game::class);
        $storage
            ->expects($this->once())
            ->method('newGame')
            ->willReturn($game);

        $storage
            ->expects($this->once())
            ->method('save');

        $this->assertSame($game, $runner->loadGame());
    }

    public function testLoadGameReturnsLoadGameWhenStorageHasGame()
    {
        $storage = $this->createMock(Storage::class);
        $wordList = $this->createMock(WordList::class);

        $runner = new Runner($storage, $wordList);

        $game = $this->createMock(Game::class);

        $storage
            ->method('hasGame')
            ->willReturn(true);

        $storage
            ->expects($this->once())
            ->method('loadGame')
            ->willReturn($game);

        $this->assertSame($game, $runner->loadGame());
    }
}