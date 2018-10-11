<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 11/10/2018
 * Time: 10:55
 */

namespace App\Controller;


use App\User\Form\RegisterModel;
use App\User\Form\RegisterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{

    /**
     * @Route("/signup", name="signup")
     */
    public function signUp(Request $request): Response
    {
        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            /** @var RegisterModel $user */

            $this->container
                ->get('usersignup_handler')
                ->handleRegisterModel($form->getData());

            /* version simple
            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            */
        }

        return $this->render('default/signup.html.twig', [
            'signup_form' => $form->createView(),
        ]);
    }
}