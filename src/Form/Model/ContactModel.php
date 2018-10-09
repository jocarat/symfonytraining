<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/10/2018
 * Time: 16:48
 */

namespace App\Form\Model;


use Symfony\Component\Validator\Constraints as Assert;

class ContactModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $firstname;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $lastname;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email(checkMX=true, message="Mauvais domaine")
     */
    public $email;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $subject;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $message;
}