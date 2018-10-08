<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 08/10/2018
 * Time: 16:55
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends Controller
{

    /**
     * @Route("/game", name="game_home")
     */
    public function home(): Response
    {
        return $this->render('game/home.html.twig');
    }

    /**
     * @Route("/game/won", name="game_won")
     */
    public function won(): Response
    {
        return $this->render('game/won.html.twig');
    }

    /**
     * @Route("/game/failed", name="game_failed")
     */
    public function failed(): Response
    {
        return $this->render('game/failed.html.twig');
    }

    /**
     * @Route(
     *     path="/game/play/{letter}",
     *     name="game_play_letter",
     *     requirements={"letter"="[a-z]"}
     * )
     */
    public function playLetter(string $letter): ?Response
    {
        return $this->redirectToRoute('game_home');
    }
}
