<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
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
}
