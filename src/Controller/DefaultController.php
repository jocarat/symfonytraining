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

class DefaultController extends Controller
{

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/home", name="homepage")
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
}
