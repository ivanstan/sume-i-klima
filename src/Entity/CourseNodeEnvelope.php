<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="course_node_envelope")
 */
class CourseNodeEnvelope extends AbstractCourseNode
{
    public const TYPE = 'envelope';

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="AbstractCourseNode", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id", nullable=false)
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var AbstractCourseNode[]
     * @ORM\OneToMany(targetEntity="App\Entity\AbstractCourseNode", mappedBy="parent")
     */
    private $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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
