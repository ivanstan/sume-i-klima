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

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\QuizResult", cascade={"persist", "remove"})
     */
    private $result;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getResult(): ?QuizResult
    {
        return $this->result;
    }

    public function setResult(?QuizResult $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

}
