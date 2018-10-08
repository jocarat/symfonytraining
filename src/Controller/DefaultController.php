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
     * @Route("/{id}", name="homepage")
     */
    public function index(int $id): Response
    {
        dump($id);
        return $this->render('default/index.html.twig',
            [
                'id' => $id,
            ]
        );
    }
}
