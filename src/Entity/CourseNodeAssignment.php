<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 */
class CourseNodeAssignment extends AbstractCourseNode
{
    public const TYPE = 'assignment';

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="AbstractCourseNode", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"api_course_instance"})
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\File")
     * @ORM\JoinColumn(name="file_id")
     * @Groups({"api_course_instance"})
     */
    private $file;

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }
}
