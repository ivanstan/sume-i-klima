<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCourseNodeQuizRepository")
 */
class UserCourseNodeQuiz extends AbstractUserCourseNodeInstance
{
    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="AbstractUserCourseNodeInstance", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id", nullable=false)
     */
    private $id;

}
