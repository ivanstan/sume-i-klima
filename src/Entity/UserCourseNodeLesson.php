<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class UserCourseNodeLesson extends AbstractUserCourseNodeInstance
{
    protected const TYPE = CourseNodeLesson::TYPE;

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="AbstractUserCourseNodeInstance", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id", nullable=false)
     */
    private $id;
}
