<?php

namespace App\Service;

use App\Entity\AbstractCourseNode;
use App\Entity\AbstractUserCourseNodeInstance;
use App\Entity\CourseInstance;
use App\Entity\CourseNodeAssignment;
use App\Entity\CourseNodeInstance;
use App\Entity\CourseNodeQuiz;
use App\Entity\File;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CourseInstanceHelper
{
    private static $options = ['groups' => ['api_course_instance'], 'skip_null_values' => true];

    /** @var CourseInstance */
    private $instance;

    /** @var EntityManagerInterface */
    private $em;

    /** @var NormalizerInterface */
    private $normalizer;

    /** @var CourseNodeQuiz[] */
    private $quizzes;

    /** @var CourseNodeAssignment[] */
    private $files;

    /** @var CourseNodeInstance[] */
    private $instances;

    public function __construct(EntityManagerInterface $em, NormalizerInterface $normalizer)
    {
        $this->em = $em;
        $this->normalizer = $normalizer;
    }

    /**
     * @return CourseInstance
     */
    public function getInstance(): CourseInstance
    {
        return $this->instance;
    }

    /**
     * @param CourseInstance
     */
    public function setInstance(CourseInstance $instance): self
    {
        $this->instance = $instance;

        $this->quizzes = $this->em->getRepository(CourseNodeQuiz::class)->getCourseQuizzes($this->instance->getCourse());

        $this->files = $this->em->getRepository(CourseNodeAssignment::class)->getCourseFiles($this->instance->getCourse());

        $this->instances = $this->em->getRepository(CourseNodeInstance::class)->getNodes($this->instance->getCourse());

        return $this;
    }


    public function getUserProgress(User $user): array
    {
        $nodes = $this
            ->em
            ->getRepository(AbstractUserCourseNodeInstance::class)
            ->getUserNodes($user, $this->instance);

        return $nodes;
    }

    public function getCourse(): array
    {
        if (!$this->instance) {
            return [];
        }

        $result = $this->normalizer->normalize($this->instance, 'json', self::$options);

        if (isset($result['course'], $result['course']['nodes'])) {
            $result['course']['nodes'] = $this->getNodes();
        }

        return $result;
    }

    private function getNodes(): array
    {
        $nodes = $this->em->getRepository(AbstractCourseNode::class)->getNodes($this->instance->getCourse());

        $nodes = $this->normalizer->normalize($nodes, 'json', self::$options);

        $this->iterate($nodes);

        return $nodes;
    }

    /**
     * @param AbstractCourseNode[] $nodes
     */
    private function iterate(&$nodes): void
    {
        foreach ($nodes as &$node) {
            $nodeId = (int)$node['id'];

            if ($node['type'] === 'quiz') {
                $quiz = $this->quizzes[$node['id']];

                $node['questions'] = $quiz->getQuestions();
            }

            if ($node['type'] === 'assignment') {
                $assignment = $this->files[$node['id']];

                $node['file'] = $assignment->getFile();
            }

            if (isset($this->instances[$nodeId])) {
                $instance = $this->instances[$nodeId];

                $node['availableAfter'] = $instance->getAvailableAfter();
            }

            if (!empty($node['children'])) {
                $this->iterate($node['children']);
            }
        }
    }
}
