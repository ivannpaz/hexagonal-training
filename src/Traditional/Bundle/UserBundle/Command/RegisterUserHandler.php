<?php

namespace Traditional\Bundle\UserBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use SimpleBus\Message\Message;
use Traditional\Bundle\UserBundle\Entity\User;
use SimpleBus\Message\Handler\MessageHandler;
use Traditional\Bundle\UserBundle\Entity\EmailAddress;

class RegisterUserHandler implements MessageHandler
{

    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    /**
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Message $message)
    {
        $user = User::register(
            EmailAddress::fromString($message->getEmail()),
            $message->getPassword(),
            $message->getCountry()
        );

        $entityManager = $this->doctrine->getManager();
        $entityManager->persist($user);
    }
}
