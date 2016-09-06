<?php

namespace Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\Event;

use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\XmlrpcScriptCallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class EndTurn extends Event implements EventInterface
{
    /**
     * @var integer
     */
    protected $index;

    public function __construct(array $parameters)
    {
        $this->index = intval($parameters[0]);
    }

    public function getName()
    {
        return XmlrpcScriptCallbackDispatcherEvents::END_TURN;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }
}
