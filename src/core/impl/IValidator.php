<?php

namespace Boutique\Core\Impl;

interface IValidator
{
    public function validate($data, $rules);
}