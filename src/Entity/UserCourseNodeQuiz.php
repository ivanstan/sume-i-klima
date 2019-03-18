<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class UserCourseNodeQuiz extends AbstractUserCourseNodeInstance
{
    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="AbstractUserCourseNodeInstance", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id", nullable=false)
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="QuizQuestionResult", cascade={"persist", "remove"})
     */
    private $result;

    public function getResult(): ?QuizQuestionResult
    {
        return $this->result;
    }

    public function setResult(?QuizQuestionResult $result): self
    {
        $this->result = $result;

        return $this;
    }
}
