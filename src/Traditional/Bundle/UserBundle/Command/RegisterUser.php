<?php

namespace Traditional\Bundle\UserBundle\Command;

use SimpleBus\Message\Name\NamedMessage;

class RegisterUser implements NamedMessage
{

    private $email;
    private $password;
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
