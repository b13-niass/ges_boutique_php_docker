<?php

namespace Boutique\Core\Impl;

interface ISession
{
    public function start();

    public function close();

    public function set($key, $value);

    public function setArray($keyPrime, $keySecond, $value);

    public function get($key);

    public function issetE($key);

    public function all();

    public function unset($key);

    public function saveObjectToSession($object, $sessionKey);

    public function restoreObjectFromSession($classEntity, $sessionKey);

    public function saveObjectToSessionArray($object, $sessionKey);

    public function restoreObjectsFromSessionArray($classEntity, $sessionKey);
}