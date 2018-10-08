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

class DefaultController extends Controller
{

    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }
}
