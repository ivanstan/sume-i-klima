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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AbstractCourseNode", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $node;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CourseInstance", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    public $instance;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

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

    public function getNode(): AbstractCourseNode
    {
        return $this->node;
    }

    public function setNode(AbstractCourseNode $node): self
    {
        $this->node = $node;

        return $this;
    }

    public function getInstance(): CourseInstance
    {
        return $this->instance;
    }

    public function setInstance(CourseInstance $instance): void
    {
        $this->instance = $instance;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
