<?php

namespace App\Controller;

use App\Entity\AbstractCourseNode;
use App\Entity\AbstractUserCourseNodeInstance;
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
    public function course(CourseInstance $instance, NormalizerInterface $normalizer): Response
    {
        $instance->getUsers(); // check if current user belongs to course instance

        $nodes = $this->getDoctrine()->getRepository(AbstractCourseNode::class)->getNodes($instance->getCourse());

        /** @var array $course */
        $course = $normalizer->normalize($instance, 'json', ['groups' => ['api_course_instance']]) ?? [];

        $options = ['groups' => ['api_course_instance'], 'skip_null_values' => true];

        if (isset($course['course'], $course['course']['nodes'])) {
            $course['course']['nodes'] = $normalizer->normalize($nodes, 'json', $options);
        }

        $response = new Response(json_encode($course));
        $response->headers->set('Content-Type', 'application/json');

//        $userNodes = $this
//            ->getDoctrine()
//            ->getRepository(AbstractUserCourseNodeInstance::class)
//            ->getUserNodes($this->getUser(), $instance)
//        ;
//
//        $nodes = $normalizer->normalize($userNodes, 'json', $options);
//        $response = new Response(json_encode($nodes));
//        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
