<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("course_node")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     CourseNodeLesson::TYPE = "App\Entity\CourseNodeLesson",
 *     CourseNodeQuiz::TYPE = "App\Entity\CourseNodeQuiz",
 *     CourseNodeAssignment::TYPE = "App\Entity\CourseNodeAssignment",
 *     CourseNodeEnvelope::TYPE = "App\Entity\CourseNodeEnvelope",
 * })
 */
abstract class AbstractCourseNode
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Course
     * @ORM\ManyToOne(targetEntity="App\Entity\Course", inversedBy="nodes")
     * @ORM\JoinColumn(name="course_id", nullable=false)
     */
    private $course;

    /**
     * @var AbstractCourseNode
     * @ORM\ManyToOne(targetEntity="App\Entity\AbstractCourseNode", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="dateinterval", nullable=true)
     */
    private $availableAfter;

    /**
     * @var AbstractCourseNode[]
     * @ORM\OneToMany(targetEntity="App\Entity\AbstractCourseNode", mappedBy="parent")
     */
    private $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }

    public function getParent(): AbstractCourseNode
    {
        return $this->parent;
    }

    /**
     * @throws \Exception
     */
    public function setParent(AbstractCourseNode $parent): void
    {
        if (!$parent instanceof CourseNodeEnvelope) {
            throw new \InvalidArgumentException(\sprintf('Attempt to set %s as a parent of %s. Only CourseNodeEnvelope can be set as parent.', get_class($parent), get_class($this)));
        }

        $this->parent = $parent;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): void
    {
        $this->weight = $weight;
    }

    public function getAvailableAfter(): ?\DateInterval
    {
        return $this->availableAfter;
    }

    public function setAvailableAfter(?\DateInterval $availableAfter): self
    {
        $this->availableAfter = $availableAfter;

        return $this;
    }

    /**
     * @return AbstractCourseNode[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param AbstractCourseNode[]
     */
    public function setChildren(array $children): void
    {
        $this->children = $children;
    }


    public function addChild(AbstractCourseNode $node): void
    {
        if (!$this->children->contains($node)) {
            $this->children[] = $node;
            $node->setParent($this);
        }
    }

    public function removeChild(AbstractCourseNode $node): void
    {
        if ($this->children->contains($node)) {
            $this->children->removeElement($node);
            // set the owning side to null (unless already changed)
            if ($node->getParent() === $this) {
                $node->setParent(null);
            }
        }
    }
}
