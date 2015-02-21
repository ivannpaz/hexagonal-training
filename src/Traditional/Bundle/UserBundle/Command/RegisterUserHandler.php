<?php

namespace Traditional\Bundle\UserBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use SimpleBus\Message\Message;
use Traditional\Bundle\UserBundle\Entity\User;
use SimpleBus\Message\Handler\MessageHandler;
use Traditional\Bundle\UserBundle\Entity\EmailAddress;
use Traditional\Bundle\UserBundle\Event\UserWasRegistered;
use SimpleBus\Message\Recorder\RecordsMessages;

class RegisterUserHandler implements MessageHandler
{

    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    /**
     * @var RecordsMessages
     */
    private $eventRecorder;

    /**
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine, RecordsMessages $eventRecorder)
    {
        $this->doctrine = $doctrine;
        $this->eventRecorder = $eventRecorder;
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

        $this->eventRecorder->record(new UserWasRegistered($user));
    }
}
