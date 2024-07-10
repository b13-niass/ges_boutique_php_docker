<?php

namespace Boutique\App\Controller;

use Boutique\App\App;
use Boutique\Core\Controller;

class ApiController extends Controller
{
    private $detteModel;

    public function __construct()
    {
        $this->detteModel = App::getInstance()->getModel('Dette');
    }

    public function show()
    {
        $dettes = $this->detteModel->getAllClientDettes('NON SOLDER');
        // dd($this->convertObjectsToArray($dettes));
        echo json_encode($this->convertObjectsToArray($dettes));
    }

    public function convertObjectsToArray(array $objects)
    {
        if (!is_array($objects)) {
            throw new \InvalidArgumentException("Expected an array of objects.");
        }

        $resultArray = [];

        foreach ($objects as $object) {
            if (!is_object($object)) {
                throw new \InvalidArgumentException("Array elements must be objects.");
            }

            $reflectionClass = new \ReflectionClass($object);
            $properties = $reflectionClass->getProperties();

            $objectData = [];
            foreach ($properties as $property) {
                $property->setAccessible(true);
                $objectData[$property->getName()] = $property->getValue($object);
            }

            $resultArray[] = $objectData;
        }

        return $resultArray;
    }
}
