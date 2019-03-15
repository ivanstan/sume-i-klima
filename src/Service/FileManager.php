<?php

namespace App\Service;

use App\Entity\File;

class FileManager
{
    /** @var string */
    private $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    public function getAbsolutePath(File $file): string
    {
        return $this->projectDir . '/' . $file->getDestination();
    }

    public function save(string $destination, string $data)
    {
        $folder = pathinfo($destination, PATHINFO_DIRNAME);
        if (!is_dir($folder) && !mkdir($folder, 0777, true) && !is_dir($folder)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $folder));
        }

        return file_put_contents($destination, $data);
    }

    public function remove(string $path): bool
    {
        return unlink($path);
    }
}
