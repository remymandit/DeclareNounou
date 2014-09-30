<?php

namespace DeclareNounou\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity("email")
 * @UniqueEntity("user")
 */
class Invitation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=10)
     */
    protected $code;

    /**
     * @ORM\Column(type="string", unique=true)
     * @
     */
    protected $email;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $sent = false;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="invitation", cascade={"persist", "merge"})
     */
    protected $user;

    public function __construct()
    {
        $this->code = substr(md5(uniqid(rand(), true)), 0, 10);
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function isSent()
    {
        return $this->sent;
    }

    public function send()
    {
        $this->sent = true;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }
}
