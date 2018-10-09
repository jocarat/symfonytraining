<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 08/10/2018
 * Time: 13:19
 */

namespace App\Controller;


use App\Game\Loader\TextFileLoader;
use App\Game\Loader\XmlFileLoader;
use App\Game\Runner;
use App\Game\Storage;
use App\Game\WordList;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends Controller
{
    /**
     * @Route("/game", name="game")
     */
    public function home(): Response
    {
        $game = $this->getGameRunner()->loadGame();
        dump($game);

        return $this->render('game/game.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/won", name="won")
     */
    public function won(): Response
    {
        $game = $this->getGameRunner()->loadGame();
        return $this->render('game/won.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/failed", name="failed")
     */
    public function failed(): Response
    {
        $game = $this->getGameRunner()->loadGame();
        return $this->render('game/failed.html.twig', [
            'game' => $game,
        ]);
    }


    /**
     * @Route("/reset_game", name="reset_game")
     */
    public function resetGame(): Response
    {
        $this->getGameRunner()->resetGame();
        return $this->redirectToRoute('game');
    }

    /**
     * @Route(
     *     "/game/play/{letter}",
     *     name="game_play_letter",
     *     requirements={"letter"="[a-zA-Z]"},
     *     )
     */
    public function playLetter(string $letter): RedirectResponse
    {
        $game = $this->getGameRunner()->playLetter($letter);
        if ($game->isHanged())
        {
            return $this->redirectToRoute('failed', ['letter' => $letter]);
        }
        elseif ($game->isWon())
        {
            return $this->redirectToRoute('won', ['letter' => $letter]);
        }
        return $this->redirectToRoute('game', ['letter' => $letter]);
    }

    /**
     * @Route(
     *     "/game/play_word",
     *     name="game_play_word",
     *     condition="request.request.has('word')",
     *     )
     */
    public function playWord(Request $request): RedirectResponse
    {
        $word = $request->request->get('word');
        $game = $this->getGameRunner()->playWord($word);
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

    private function getGameRunner(): Runner
    {
        $session = $this->get('session');
        $storage = new Storage($session);

        $wordList = new WordList([
            $this->getParameter('kernel.project_dir') . '/data/words.txt',
            $this->getParameter('kernel.project_dir') . '/data/words.xml',
        ]);

        $textFileLoader = new TextFileLoader();
        $wordList->addLoader($textFileLoader);

        $xmlFileLoader = new XmlFileLoader();
        $wordList->addLoader($xmlFileLoader);

        $runner = new Runner($storage, $wordList);

        return $runner;
    }
}
