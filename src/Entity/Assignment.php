<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssignmentRepository")
 * @ORM\Table(name="course_node_assigment")
 */
class Assignment
{
    public const TYPE = 'assignment';

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="AbstractCourseNode", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id", nullable=false)
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
