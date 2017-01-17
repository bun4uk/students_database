<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 17.01.17
 * Time: 15:47
 */

namespace StudentBundle\Service;

use Doctrine\ORM\EntityManager;
use StudentBundle\Entity\Student;
use StudentBundle\Repository\StudentRepository;

class SlugHelper
{
    /**
     * @var array
     */
    protected $duplicates;

    public function __construct()
    {;
        $this->duplicates = [];
    }

    /**
     * @param $name
     * @return string
     */
    public function generateSlug($name)
    {
        $simpleSlug = preg_replace('#[^a-z]+#', '_', strtolower($name));
        $isSlugUsed = $this->isUsed($simpleSlug);
        if ($isSlugUsed === false) {
            return $simpleSlug;
        }
        return $simpleSlug . '_' . $isSlugUsed;
    }

    /**
     * @param $slug
     * @return bool|int
     */
    private function isUsed($slug)
    {
        if (array_key_exists($slug, $this->duplicates)) {
            $count = $this->duplicates[$slug];
            $this->duplicates[$slug] = ++$count;
            return $count;
        }
        $this->duplicates[$slug] = 1;

        return false;
    }
}