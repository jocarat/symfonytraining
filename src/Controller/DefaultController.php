<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 08/10/2018
 * Time: 13:19
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class DefaultController
{
    /**
     * @var \Twig\Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function index(): Response
    {
        $response = new Response();
        $response->setContent(
          $this->twig->render('default/index.html.twig')
        );

        return $response;
    }
}
