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
use Doctrine\Common\Persistence\ObjectManager;

class UserSignupHandler
{
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    public function handleRegisterModel(RegisterModel $data)
    {
        $user = new User();
        $user->setUsername($data->username);
        $user->setPassword($data->password);
        dump($user);
        $this->manager->persist($user);
        $this->manager->flush();
    }
}