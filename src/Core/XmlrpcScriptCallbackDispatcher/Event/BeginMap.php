<?php

namespace Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\Event;

use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\XmlrpcScriptCallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class BeginMap extends Event implements EventInterface
{
    /**
     * @var integer
     */
    protected $mapIndex;

    /**
     * @var string
     */
    protected $mapUid;

    /**
     * @var boolean
     */
    protected $restarted;

    public function __construct(array $parameters)
    {
        $this->mapIndex = intval($parameters[0]);
        $this->mapUid = $parameters[1];
        $this->restarted = boolval($parameters[2]);
    }

    public function getName()
    {
        return XmlrpcScriptCallbackDispatcherEvents::BEGIN_MAP;
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

    /**
     * @return boolean
     */
    public function isRestarted(): bool
    {
        return $this->restarted;
    }
}
