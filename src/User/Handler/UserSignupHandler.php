<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 11/10/2018
 * Time: 10:23
 */

namespace App\User\Handler;


use App\Entity\User;
use App\User\Form\RegisterModel;
use App\User\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserSignupHandler extends Controller
{
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function handleRegisterModel(RegisterModel $data)
    {
        $user = new User();
        $user->setUsername($data->username);
        $user->setPassword($data->password);

        $this->userManager->createUser($user);
    }
}