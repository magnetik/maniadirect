<?php

namespace Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\Event;

use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\XmlrpcScriptCallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class EndMap extends Event implements EventInterface
{
    /**
     * @var integer
     */
    protected $mapIndex;

    /**
     * @var string
     */
    protected $mapUid;

    public function __construct(array $parameters)
    {
        $this->mapIndex = intval($parameters[0]);
        $this->mapUid = $parameters[1];
    }

    public function getName()
    {
        return XmlrpcScriptCallbackDispatcherEvents::END_MAP;
    }

    /**
     * @return int
     */
    public function getMapIndex(): int
    {
        return $this->mapIndex;
    }

    /**
     * @return string
     */
    public function getMapUid(): string
    {
        return $this->mapUid;
    }
}
