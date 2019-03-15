<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(name="course_node_lesson")
 */
class CourseNodeLesson extends AbstractCourseNode
{
    public const TYPE = 'lesson';

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="AbstractCourseNode", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id", nullable=false)
     * @Groups({"api_course_instance"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"api_course_instance"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"api_course_instance"})
     */
    private $url;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
