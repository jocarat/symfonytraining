<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 11/10/2018
 * Time: 10:31
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class User
 *
 * @ORM\Entity()
 * @ORM\Table("user")
 * @package App\Entity
 */
class User
{
    /** @var int
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @var string
     *
     * @ORM\Column(type="string")
     */
    private $username;

    /** @var string
     *
     * @ORM\Column(type="string")
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername():string
    {
        return $this->username;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }
}