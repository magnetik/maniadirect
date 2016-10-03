<?php

namespace Nadeo\Live\ManiaDirect\Tests\Core\Utils;

class TestEventListener
{
    private $calls;

    public function __construct()
    {
        $this->calls = [];
    }

    public function __call($name, $arguments)
    {
        $this->calls[] = [
            "methodName" => $name,
            "arguments" => $arguments
        ];
    }

    public function getCalls()
    {
        return $this->calls;
    }
}
