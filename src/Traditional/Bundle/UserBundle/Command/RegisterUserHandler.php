<?php

namespace Traditional\Bundle\UserBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use SimpleBus\Message\Name\NamedMessage;
use SimpleBus\Message\Message;
use Traditional\Bundle\UserBundle\Entity\User;
use SimpleBus\Message\Handler\MessageHandler;

class RegisterUserHandler implements MessageHandler
{

    private $doctrine;
    private $mailer;

    public function __construct(ManagerRegistry $doctrine, $mailer)
    {
        $this->doctrine = $doctrine;
        $this->mailer = $mailer;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Message $message)
    {
        $user = User::register(
            $message->getEmail(),
            $message->getPassword(),
            $message->getCountry()
        );

        $entityManager = $this->doctrine->getManager();
        $entityManager->persist($user);

        $emailMessage = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $emailMessage->setTo($user->getEmail());
        $this->mailer->send($emailMessage);
    }
}
