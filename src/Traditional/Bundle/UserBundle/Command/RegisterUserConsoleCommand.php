<?php

namespace Traditional\Bundle\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Traditional\Bundle\UserBundle\Command\RegisterUser;
use Traditional\Bundle\UserBundle\Form\CreateUserType;

class RegisterUserConsoleCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('user:register');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $formHelper = $this->getHelper('form');

        $command = $formHelper->interactUsingForm(
            new CreateUserType(),
            $input,
            $output
        );

        $this->getContainer()->get('command_bus')->handle($command);
    }
}
