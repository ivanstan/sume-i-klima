<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CourseNodeInstanceRepository")
 */
class CourseNodeInstance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AbstractCourseNode")
     * @ORM\JoinColumn(nullable=false)
     */
    private $node;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CourseInstance")
     * @ORM\JoinColumn(nullable=false)
     */
    private $instance;

    /**
     * @ORM\Column(type="dateinterval", nullable=true)
     */
    private $availableAfter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNode(): ?AbstractCourseNode
    {
        return $this->node;
    }

    public function setNode(?AbstractCourseNode $node): self
    {
        $this->node = $node;

        return $this;
    }

    public function getInstance(): ?CourseInstance
    {
        return $this->instance;
    }

    public function setInstance(?CourseInstance $instance): self
    {
        $this->instance = $instance;

        return $this;
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
}
