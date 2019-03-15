<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCourseNodeAssignmentRepository")
 */
class UserCourseNodeAssignment extends AbstractUserCourseNodeInstance
{
    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="AbstractUserCourseNodeInstance", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id", nullable=false)
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
