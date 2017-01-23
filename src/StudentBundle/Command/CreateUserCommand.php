<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 12.01.17
 * Time: 17:42
 */

namespace StudentBundle\Command;

use StudentBundle\Service\StudentService;
use StudentBundle\Traits\MemoryUsage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends ContainerAwareCommand
{
    use MemoryUsage;


    const BYTES_IN_MEGABYTES = 1048576;

    /**
     *
     */
    protected function configure()
    {
        $this->setName('app:create-students')
            ->setDescription('Creates students.')
            ->setHelp('This command allows you to create students...');
    }

    protected function execute(OutputInterface $output)
    {
        $output->writeln($this->getMemoryReport(self::BYTES_IN_MEGABYTES));
        $start_time = microtime(true);
        $progressBar = new ProgressBar($output);
        $this->getStudentsHelper()->generateSlugsForStudents($progressBar);
        $output->writeln($this->getMemoryReport(self::BYTES_IN_MEGABYTES));
        $output->writeln('Generated in ' . round(microtime(true) - $start_time, 2) . ' seconds');

        return 0;
    }

    protected function getStudentsHelper()
    {
        return $this->getContainer()->get('students_service');
    }
}
