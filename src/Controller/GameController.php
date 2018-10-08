<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 08/10/2018
 * Time: 13:19
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends Controller
{
    /**
     * @Route("/game", name="game")
     */
    public function home(): Response
    {
        return $this->render('game/home.html.twig');
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
    public function playLetter(string $letter)
    {
        dump($letter);
        return $this->redirectToRoute('game', ['letter' => $letter]);
    }
}
