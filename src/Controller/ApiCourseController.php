<?php

namespace App\Controller;

use App\Entity\AbstractCourseNode;
use App\Entity\CourseInstance;
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
    public function course(CourseInstance $instance, NormalizerInterface $serializer): Response
    {
        $instance->getUsers(); // check if current user belongs to course instance

        $nodes = $this->getDoctrine()->getRepository(AbstractCourseNode::class)->getNodes($instance->getCourse());

        /** @var array $course */
        $course = $serializer->normalize($instance, 'json', ['groups' => ['api_course_instance']]) ?? [];

        if (isset($course['course'], $course['course']['nodes'])) {
            $course['course']['nodes'] = $serializer->normalize($nodes, 'json', ['groups' => ['api_course_instance'], 'skip_null_values' => true]);
        }

        $response = new Response(json_encode($course));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
