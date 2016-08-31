<?php

namespace Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\Event;

use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\XmlrpcScriptCallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class OnHit extends Event implements EventInterface
{
    /**
     * @var string
     */
    protected $shooter;

    /**
     * @var string
     */
    protected $victim;

    /**
     * @var integer
     */
    protected $damages;

    /**
     * @var integer
     */
    protected $weapon;

    /**
     * @var integer
     */
    protected $shooterPoints;

    /**
     * @var float
     */
    protected $hitDistance;

    /**
     * @var mixed
     */
    protected $shooterPosition;

    protected $victimPosition;

    protected $shooterAimDirection;

    protected $victimAimDirection;

    public function __construct(array $parameters)
    {
        $this->shooter = $parameters[0];
        $this->victim = $parameters[1];
        $this->damages = floatval($parameters[2]);
        $this->weapon = intval($parameters[3]);
        $this->shooterPoints = intval($parameters[4]);
        $this->hitDistance = floatval($parameters[5]);
        $this->shooterPosition = $parameters[6];
        $this->victimPosition = $parameters[7];
        $this->shooterAimDirection = $parameters[8];
        $this->victimAimDirection = $parameters[9];
    }

    public function getName()
    {
        return XmlrpcScriptCallbackDispatcherEvents::ON_HIT;
    }

}
