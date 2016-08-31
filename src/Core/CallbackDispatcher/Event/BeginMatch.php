<?php

namespace Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\Event;

use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class BeginMatch extends Event implements EventInterface
{
    public function getName()
    {
        return CallbackDispatcherEvents::BEGIN_MATCH;
    }
}
