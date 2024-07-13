<?php

namespace Boutique\Core\Impl;

interface IFile
{
    public function load($fileKey);
    public function setDir($dir);
}