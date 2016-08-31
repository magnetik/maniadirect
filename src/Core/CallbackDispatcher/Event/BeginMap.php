<?php

namespace Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\Event;

use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class BeginMap extends Event implements EventInterface
{
    public function __construct(array $parameters)
    {
    }

    public function getName()
    {
        return CallbackDispatcherEvents::BEGIN_MAP;
    }
}
