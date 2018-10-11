<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 11/10/2018
 * Time: 13:52
 */

namespace App\User\Manager;


use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;

class UserManager
{
    /**
     * @var ObjectManager
     */
    private $manager;



    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function createUser(User $user)
    {
        $this->manager->persist($user);
        $this->manager->flush();
    }
}