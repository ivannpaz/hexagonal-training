<?php

namespace Traditional\Bundle\UserBundle\Event;

use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;

class WhenUserWasRegisteredSendWelcomeEmail implements MessageSubscriber
{

    private $mailer;

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param  Message $message
     */
    public function notify(Message $message)
    {
        $emailMessage = \Swift_Message::newInstance('Welcome', 'Yes, welcome');

        $emailMessage->setTo((string)$message->getUser()->getEmail());
        $this->mailer->send($emailMessage);
    }
}
