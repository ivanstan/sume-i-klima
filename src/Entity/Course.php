<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 */
class Course
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"api_course_instance"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"api_course_instance"})
     */
    private $name;

    /**
     * @Groups({"api_course_instance"})
     * @ORM\Column(type="string", length=2)
     */
    private $language;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AbstractCourseNode", mappedBy="course")
     * @ORM\OrderBy({"weight": "DESC"})
     * @Groups({"api_course_instance"})
     */
    private $nodes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CourseInstance", mappedBy="course")
     */
    private $instances;

    public function __construct()
    {
        $this->nodes = new ArrayCollection();
        $this->instances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return Collection|AbstractCourseNode[]
     */
    public function getNodes(): Collection
    {
        return $this->nodes;
    }

    public function addNode(AbstractCourseNode $node): void
    {
        if (!$this->nodes->contains($node)) {
            $this->nodes[] = $node;
            $node->setCourse($this);
        }
    }

    public function removeNode(AbstractCourseNode $node): void
    {
        if ($this->nodes->contains($node)) {
            $this->nodes->removeElement($node);
            // set the owning side to null (unless already changed)
            if ($node->getCourse() === $this) {
                $node->setCourse(null);
            }
        }
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return Collection|CourseInstance[]
     */
    public function getInstances(): Collection
    {
        return $this->instances;
    }

    public function addInstance(CourseInstance $instance): self
    {
        if (!$this->instances->contains($instance)) {
            $this->instances[] = $instance;
            $instance->setCourse($this);
        }

        return $this;
    }

    public function removeInstance(CourseInstance $instance): self
    {
        if ($this->instances->contains($instance)) {
            $this->instances->removeElement($instance);
            // set the owning side to null (unless already changed)
            if ($instance->getCourse() === $this) {
                $instance->setCourse(null);
            }
        }

        return $this;
    }
}
