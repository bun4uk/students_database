<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 17.01.17
 * Time: 15:40
 */

namespace StudentBundle\Service;

use Doctrine\ORM\EntityManager;
use StudentBundle\Command\CreateUserCommand;
use StudentBundle\Entity\Student;
use StudentBundle\Repository\StudentRepository;
use Symfony\Component\Console\Helper\ProgressBar;
use StudentBundle\Traits\MemoryUsage;

class StudentService
{
    use MemoryUsage;

    const MAX_ITEMS_IN_MEMORY = 1000;

    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var StudentRepository
     */
    private $studentsRepo;
    /**
     * @var SlugHelper
     */
    private $slugHelper;

    /**
     * StudentsService constructor.
     * @param EntityManager $entityManager
     * @param SlugHelper $slugHelper
     */
    public function __construct(EntityManager $entityManager, SlugHelper $slugHelper)
    {
        $this->entityManager = $entityManager;
        $this->entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $this->studentsRepo = $entityManager->getRepository(Student::class);
        $this->slugHelper = $slugHelper;
    }

    /**
     * @param ProgressBar $progressBar
     * @return bool
     */
    public function generateSlugsForStudents(ProgressBar $progressBar)
    {
        $emptySlugsCount = $this->studentsRepo->getCount();
        if ($emptySlugsCount > 0) {
            $students = $this->studentsRepo->getStudentsWithoutSlug();

            $studentsIterator = $students->iterate();
            $progressBar->start();
            $i = 0;
            foreach ($studentsIterator as $studentQuery) {
                echo $this->getMemoryReport(CreateUserCommand::BYTES_IN_MEGABYTES);
                /** @var Student $student */
                $student = $studentQuery[0];
                $student->setPath(
                    $this->slugHelper->generateSlug(
                        $student->getName()
                    )
                );
                if ((++$i % self::MAX_ITEMS_IN_MEMORY) === 0) {
                    $this->entityManager->flush();
                    $this->entityManager->clear();
                }
                $progressBar->advance();
            }
            $this->entityManager->flush();
            $progressBar->finish();
        }

        return true;
    }
}
