<?php

namespace App\Controller;

use App\Entity\CourseInstance;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    /**
     * @Route("/course/{course}", name="app_course_view")
     * @IsGranted("view", subject="course")
     */
    public function index(CourseInstance $course): Response
    {
        return $this->render('pages/course/view.html.twig', [
            'course' => $course
        ]);
    }
}
