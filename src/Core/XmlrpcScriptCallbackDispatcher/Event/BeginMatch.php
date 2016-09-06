<?php

namespace Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\Event;

use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\XmlrpcScriptCallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class BeginMatch extends Event implements EventInterface
{
    /**
     * @var integer
     */
    protected $index;

    /**
     * @var bool
     */
    protected $restarted;

    public function __construct(array $parameters)
    {
        $this->index = intval($parameters[0]);
        $this->restarted = boolval($parameters[1]);
    }

    public function getName()
    {
        return XmlrpcScriptCallbackDispatcherEvents::BEGIN_MATCH;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @return boolean
     */
    public function isRestarted(): bool
    {
        return $this->restarted;
    }
}
