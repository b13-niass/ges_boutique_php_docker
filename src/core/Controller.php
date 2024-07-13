<?php

namespace Boutique\Core;

use Boutique\Core\Impl\IAuthorize;
use Boutique\Core\Impl\IFile;
use Boutique\Core\Impl\ISession;
use Boutique\Core\Impl\IValidator;

class Controller
{
    protected ?ISession $session = null;
    protected ?IValidator $validator = null;
    protected ?IAuthorize $authorize = null;
    protected ?IFile $file = null;
    protected $layout = "layout_default";


    public function __construct(IValidator $validator, ISession $session,
                                IFile $file,
                                IAuthorize $authorize)
    {
        $this->session = $session;
        $this->validator = $validator;
        $this->file = $file;
        $this->authorize = $authorize;
    }

    public function renderView($view, $data = [])
    {
        if (count($data)) {
            extract($data);
        }
        $session = $this->session;
//        ob_clean();
//        dd($session);
        ob_start();
        require_once $_ENV['VIEW_DIR'] . "{$view}.html.php";
        $content = ob_get_clean();
        require_once $_ENV['VIEW_DIR'] . "/layouts/{$this->layout}.html.php";
    }

    public function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }


    public static function toJSON($object)
    {
        $reflectionClass = new \ReflectionClass($object);
        $properties = $reflectionClass->getProperties();

        $sessionData = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $sessionData[$property->getName()] = $property->getValue($object);
        }

        return json_encode($sessionData);
    }

    public static function toObject(array $arr, $classEntity)
    {
        $classEntity = "Boutique\\App\\Entity\\{$classEntity}Entity";

        $reflectionClass = new \ReflectionClass($classEntity);
        $object = $reflectionClass->newInstanceWithoutConstructor();

        foreach ($arr as $propertyName => $value) {
            $property = $reflectionClass->getProperty($propertyName);
            $property->setAccessible(true);
            $property->setValue($object, $value);
        }

        return $object;
    }

    // public static function saveObjectToSessionArray($object, $sessionKey)
    // {
    //     $reflectionClass = new \ReflectionClass($object);
    //     $properties = $reflectionClass->getProperties();

    //     $sessionData = [];
    //     foreach ($properties as $property) {
    //         $property->setAccessible(true);
    //         $sessionData[$property->getName()] = $property->getValue($object);
    //     }

    //     if (!isset($_SESSION[$sessionKey])) {
    //         $_SESSION[$sessionKey] = [];
    //     }

    //     $_SESSION[$sessionKey][] = $sessionData;
    // }

    // public static function restoreObjectsFromSessionArray($classEntity, $sessionKey)
    // {
    //     if (!Session::issetE($sessionKey)) {
    //         return [];
    //     }
    //     $classEntity = "Boutique\\App\\Entity\\{$classEntity}Entity";

    //     $sessionDataArray = $_SESSION[$sessionKey];
    //     $objects = [];

    //     foreach ($sessionDataArray as $sessionData) {
    //         $reflectionClass = new \ReflectionClass($classEntity);
    //         $object = $reflectionClass->newInstanceWithoutConstructor();

    //         foreach ($sessionData as $propertyName => $value) {
    //             $property = $reflectionClass->getProperty($propertyName);
    //             $property->setAccessible(true);
    //             $property->setValue($object, $value);
    //         }

    //         $objects[] = $object;
    //     }

    //     return $objects;
    // }

}
