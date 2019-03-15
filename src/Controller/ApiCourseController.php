<?php

namespace App\Controller;

use App\Entity\AbstractCourseNode;
use App\Entity\CourseInstance;
use App\Entity\File;
use App\Service\FileManager;
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
    public function course(CourseInstance $instance, SerializerInterface $serializer, FileManager $fileManager): Response
    {
        $instance->getUsers(); // check if current user belongs to course instance

        $nodes = $this->getDoctrine()->getRepository(AbstractCourseNode::class)->getNodes($instance->getCourse());

        $course = $serializer->serialize($nodes, 'json', ['groups' => ['api_course_instance']]);

        $response = new Response($course);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
