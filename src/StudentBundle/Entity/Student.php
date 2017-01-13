<?php

/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 12.01.17
 * Time: 14:55
 */

namespace StudentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Student
 * @package StudentBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="student")
 */
class Student
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var
     *
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @var
     *
     * @ORM\Column(type="string", length=500)
     */
    private $description;

    /**
     * @var
     *
     * @ORM\Column(type="string", length=100)
     */
    private $path;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $name
     *
     * @return Student
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Student
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Student
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
