<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 08/10/2018
 * Time: 13:19
 */

namespace App\Controller;


use App\Form\Model\ContactModel;
use App\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            /** @var ContactModel $contactMessage */
            $contactMessage = $form->getData();

        }

        return $this->render('default/contact.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }

}
