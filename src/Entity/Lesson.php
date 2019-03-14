<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LessonRepository")
 * @ORM\Table(name="course_node_lesson")
 */
class Lesson
{
    public const TYPE = 'lesson';

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
