<?php

namespace App\Controller;

use App\Entity\File;
use App\Service\FileManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/file")
 */
class FileController extends AbstractController
{
    /**
     * @Route("/download/{file}", name="system_file_download")
     */
    public function download(File $file, FileManager $manager): BinaryFileResponse
    {
        return new BinaryFileResponse($manager->getAbsolutePath($file));
    }
}
