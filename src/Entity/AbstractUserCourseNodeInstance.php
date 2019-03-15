<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_course_node_instance")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     CourseNodeLesson::TYPE = "App\Entity\UserCourseNodeLesson",
 *     CourseNodeQuiz::TYPE = "App\Entity\UserCourseNodeQuiz",
 *     CourseNodeAssignment::TYPE = "App\Entity\UserCourseNodeAssignment",
 *     CourseNodeEnvelope::TYPE = "App\Entity\UserCourseNodeEnvelope",
 * })
 */
abstract class AbstractUserCourseNodeInstance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CourseNodeInstance", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $courseNodeInstance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCourseNodeInstance(): ?CourseNodeInstance
    {
        return $this->courseNodeInstance;
    }

    public function setCourseNodeInstance(CourseNodeInstance $courseNodeInstance): self
    {
        $this->courseNodeInstance = $courseNodeInstance;

        return $this;
    }
}
