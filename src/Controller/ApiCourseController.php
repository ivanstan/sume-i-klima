<?php

namespace App\Controller;

use App\Entity\AbstractUserCourseNodeInstance;
use App\Entity\CourseInstance;
use App\Service\CourseInstanceHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/api")
 */
class ApiCourseController extends AbstractController
{
    /**
     * @Route("/course/{instance}", name="api_course_instance")
     */
    public function course(CourseInstance $instance, CourseInstanceHelper $helper, NormalizerInterface $normalizer): Response
    {
        $instance->getUsers(); // check if current user belongs to course instance

        $options = ['groups' => ['api_course_instance'], 'skip_null_values' => true];

        $nodes = $normalizer->normalize([
            'instance' => $helper->setInstance($instance)->getCourse(),
            'progress' => $helper->setInstance($instance)->getUserProgress($this->getUser())
        ], 'json', $options);
        $response = new Response(json_encode($nodes));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
