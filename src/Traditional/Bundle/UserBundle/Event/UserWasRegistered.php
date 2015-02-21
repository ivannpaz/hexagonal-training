<?php

namespace Traditional\Bundle\UserBundle\Event;

use Traditional\Bundle\UserBundle\Entity\User;
use SimpleBus\Message\Name\NamedMessage;

class UserWasRegistered implements NamedMessage
{

    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public static function messageName()
    {
        return 'user_was_registered';
    }
}
