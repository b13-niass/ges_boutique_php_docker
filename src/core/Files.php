<?php

namespace Boutique\Core;

use Boutique\Core\Impl\IFile;

class Files implements IFile
{

    private array $imagesTypes = ['jpg', 'png', 'gif', 'pdf'];
    private string $dir = uploadDir;

    public function load($fileKey)
    {
        if (!isset($_FILES[$fileKey])) {
            return false;
        }

        $file = $_FILES[$fileKey];

        if (!is_array($file['name'])) {
            if (!is_string($file['name'])) {
                return false;
            }

            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

            $fileName = uniqid() . '.' . $fileExtension;

            $targetFilePath = rtrim($this->dir, '/') . '/' . $fileName;

            if (!is_dir($this->dir)) {
                if (!mkdir($this->dir, 0777, true)) {
                    return false;
                }
            }

            if (!move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return false;
            }

            return $fileName;
        } else {
            $fileNames = [];

            foreach ($file['name'] as $index => $name) {
                if (!is_string($name)) {
                    continue;
                }

                $fileExtension = pathinfo($name, PATHINFO_EXTENSION);

                $fileName = uniqid() . '.' . $fileExtension;

                $targetFilePath = rtrim($this->dir, '/') . '/' . $fileName;

                if (!is_dir($this->dir)) {
                    if (!mkdir($this->dir, 0777, true)) {
                        continue;
                    }
                }

                if (move_uploaded_file($file['tmp_name'][$index], $targetFilePath)) {
                    $fileNames[] = $fileName;
                }
            }

            return $fileNames;
        }

        return false;
    }

//    public function __set($name, $value)
//    {
//        $this->$name = $value;
//        return $this;
//    }
//
//    public function __get($name)
//    {
//        return $this->$name;
//    }

    public function setDir($dir)
    {
        $this->dir = $dir;
    }

}
