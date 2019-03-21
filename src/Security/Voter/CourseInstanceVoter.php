<?php

namespace App\Security\Voter;

use App\Entity\Course;
use App\Entity\CourseInstance;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class CourseInstanceVoter extends Voter implements VoterInterface
{
    private const VIEW = 'view';

    protected function supports($attribute, $subject): bool
    {
        if ($attribute !== self::VIEW) {
            return false;
        }

        if (!$subject instanceof CourseInstance) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        if ($user->hasRole(User::ROLE_ADMIN)) {
            return true;
        }

        /** @var CourseInstance $course */
        $course = $subject;

        if ($attribute === self::VIEW) {

            $users = $course->getUsers()->toArray();

            if (\array_key_exists($user->getId(), $users)) {
                return true;
            }
        }

        return false;
    }
}
