<?php

namespace App\Controller;

use App\Entity\CourseInstance;
use App\Service\CourseInstanceHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted("view", subject="instance")
     */
    public function course(
        CourseInstance $instance,
        CourseInstanceHelper $helper,
        SerializerInterface $normalizer
    ): Response
    {
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
