<?php

namespace Traditional\Bundle\UserBundle\Command;

use SimpleBus\Message\Name\NamedMessage;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser implements NamedMessage
{

    /**
     * @Assert\Email
     * @var string
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @var string
     */
    private $password;

    /**
     * @Assert\Country
     * @var string
     */
    private $country;

    public function __construct($email, $password, $country)
    {
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
    }


    /**
     * {@inheritdoc}
     */
    public static function messageName()
    {
        return 'register_user';
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }
}
