<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizRepository")
 * @ORM\Table(name="course_node_quiz")
 */
class Quiz
{
    public const TYPE = 'quiz';

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
