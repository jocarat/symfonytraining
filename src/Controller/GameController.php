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
        return $this->render('game/home.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/won", name="won")
     */
    public function won(): Response
    {
        return $this->render('game/won.html.twig');
    }

    /**
     * @Route("/failed", name="failed")
     */
    public function failed(): Response
    {
        return $this->render('game/failed.html.twig');
    }

    /**
     * @Route(
     *     "/game/play/{letter}",
     *     name="game_play_letter",
     *     requirements={"letter"="[a-zA-Z]"})
     */
    public function playLetter(string $letter): RedirectResponse
    {
        dump($letter);
        return $this->redirectToRoute('game', ['letter' => $letter]);
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
