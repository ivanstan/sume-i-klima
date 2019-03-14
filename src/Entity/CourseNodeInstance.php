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
     * @ORM\ManyToOne(targetEntity="App\Entity\AbstractCourseNode")
     * @ORM\JoinColumn(nullable=false)
     */
    private $node;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\CourseInstance")
     * @ORM\JoinColumn(nullable=false)
     */
    private $instance;

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
}
