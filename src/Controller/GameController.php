<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 08/10/2018
 * Time: 13:19
 */

namespace App\Controller;

use App\Game\Runner;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/game")
 */
class GameController extends Controller
{
    const LETTER = 'letter';
    /**
     * @Route("", name="game")
     */
    public function home(Runner $runner): Response
    {
        $game = $runner->loadGame();
        dump($game);

        return $this->render('game/game.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/won", name="won")
     */
    public function won(Runner $runner): Response
    {
        $game = $runner->loadGame();
        return $this->render('game/won.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/failed", name="failed")
     */
    public function failed(Runner $runner): Response
    {
        $game = $runner->loadGame();
        return $this->render('game/failed.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/reset", name="reset_game")
     */
    public function resetGame(Runner $runner): Response
    {
        $runner->resetGame();
        return $this->redirectToRoute('game');
    }

    /**
     * @Route(
     *     "/play/{letter}",
     *     name="game_play_letter",
     *     requirements={"letter"="[a-zA-Z]"},
     *     )
     */
    public function playLetter(Runner $runner, string $letter): RedirectResponse
    {
        $game = $runner->playLetter($letter);
        if ($game->isHanged())
        {
            return $this->redirectToRoute('failed', [self::LETTER => $letter]);
        }
        elseif ($game->isWon())
        {
            return $this->redirectToRoute('won', [self::LETTER => $letter]);
        }
        return $this->redirectToRoute('game', [self::LETTER => $letter]);
    }

    /**
     * @Route(
     *     "/play_word",
     *     name="game_play_word",
     *     condition="request.request.has('word')",
     *     )
     */
    public function playWord(Runner $runner, Request $request): RedirectResponse
    {
        $word = $request->request->get('word');
        $game = $runner->playWord($word);
        if ($game->isHanged())
        {
            return $this->redirectToRoute('failed');
        }
        elseif ($game->isWon())
        {
            return $this->redirectToRoute('won');
        }
        return $this->redirectToRoute('game', ['word' => $word]);
    }
}
