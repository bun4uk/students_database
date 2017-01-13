<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 12.01.17
 * Time: 17:42
 */

namespace StudentBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class CreateUserCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:create-users')
            ->setDescription('Creates new users.')
            ->setHelp('This command allows you to create users...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
                             'User Creator',
                             '============',
                             '',
                         ]);

        // outputs a message followed by a "\n"
        $output->writeln('Whoa!');

        // outputs a message without adding a "\n" at the end of the line
        $output->write('You are about to ');
        $output->write('create a user.');
    }
}