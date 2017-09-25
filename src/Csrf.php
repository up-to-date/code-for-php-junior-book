<?php

namespace App;

use Slim\Csrf\Guard;

class Csrf  extends Guard
{
    public function getAll()
    {
        return [
            'nameKey' => $this->getTokenNameKey(),
            'name' => $this->getTokenName(),
            'valueKey' => $this->getTokenValueKey(),
            'value' => $this->getTokenValue()
        ];
    }
}