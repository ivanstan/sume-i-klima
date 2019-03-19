<?php

namespace App\Controller;

use App\Entity\CourseInstance;
use App\Service\CourseInstanceHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api")
 */
class ApiCourseController extends AbstractController
{
    /**
     * @Route("/course/{instance}", name="api_course_instance")
     */
    public function course(
        CourseInstance $instance,
        CourseInstanceHelper $helper,
        SerializerInterface $normalizer
    ): Response
    {
        $instance->getUsers(); // check if current user belongs to course instance

        $data = [
            'instance' => $helper->setInstance($instance)->getCourse(),
            'progress' => $helper->setInstance($instance)->getUserProgress($this->getUser())
        ];

        $nodes = $normalizer->serialize($data, 'json', CourseInstanceHelper::$options);
        $response = new Response($nodes);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
