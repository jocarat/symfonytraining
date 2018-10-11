<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/10/2018
 * Time: 16:48
 */

namespace App\User\Form;


use Symfony\Component\Validator\Constraints as Assert;

class RegisterModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $username;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="5")
     */
    public $password;
}