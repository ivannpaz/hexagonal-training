<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Assert\Assertion;
use Traditional\Bundle\UserBundle\Entity\EmailAddress;
use Symfony\Component\Intl\Intl;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use Traditional\Bundle\UserBundle\Event\UserWasRegistered;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;

/**
 * @ORM\Entity
 * @ORM\Table(name="traditional_user")
 */
class User implements ContainsRecordedMessages
{

    use PrivateMessageRecorderCapabilities;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @param string $email
     * @param string $password
     * @param string $country
     */
    private function __construct(EmailAddress $email, $password, $country)
    {
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setCountry($country);
    }

    public static function register(EmailAddress $email, $password, $country)
    {
        $user = new self($email, $password, $country);

        $user->record(new UserWasRegistered($user));

        return $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return EmailAddress::fromString($this->email);
    }

    private function setEmail(EmailAddress $email)
    {
        $this->email = (string)$email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    private function setPassword($password)
    {
        Assertion::string($password);
        Assertion::notEmpty($password);

        $this->password = $password;
    }

    public function getCountry()
    {
        return $this->country;
    }

    private function setCountry($country)
    {
        Assertion::string($country);
        Assertion::notNull(Intl::getRegionBundle()->getCountryName($country), 'Not a country');

        $this->country = $country;
    }
}
