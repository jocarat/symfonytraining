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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserSignupHandler extends Controller
{
    private $userManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoderInterface;

    public function __construct(UserManager $userManager, UserPasswordEncoderInterface $userPasswordEncoderInterface)
    {
        $this->userManager = $userManager;
        $this->userPasswordEncoderInterface = $userPasswordEncoderInterface;
    }

    public function handleRegisterModel(RegisterModel $data)
    {
        $user = new User();
        $user->setUsername($data->username);
        $user->setPassword($this->userPasswordEncoderInterface->encodePassword($user, $data->password));


        $this->userManager->createUser($user);
    }
}