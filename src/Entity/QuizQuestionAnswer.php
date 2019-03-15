<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizQuestionAnswerRepository")
 */
class QuizQuestionAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $correct;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuizQuestion", inversedBy="answers")
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuizAnwser", inversedBy="answers")
     */
    private $answer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCorrect(): ?bool
    {
        return $this->correct;
    }

    public function setCorrect(bool $correct): self
    {
        $this->correct = $correct;

        return $this;
    }

    public function getQuestion(): ?QuizQuestion
    {
        return $this->question;
    }

    public function setQuestion(?QuizQuestion $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?QuizAnwser
    {
        return $this->answer;
    }

    public function setAnswer(?QuizAnwser $answer): self
    {
        $this->answer = $answer;

        return $this;
    }
}
