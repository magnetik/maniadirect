<?php

namespace Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\Event;

use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class ModeScriptCallback extends Event implements EventInterface
{
    /**
     * @var string
     */
    protected $callbackName;

    /**
     * @var string
     */
    protected $callbackParameter;

    public function __construct(array $parameters)
    {
        $this->callbackName = $parameters[0];
        $this->callbackParameter = $parameters[1];
    }

    public function getName()
    {
        return CallbackDispatcherEvents::MODE_SCRIPT_CALLBACK;
    }

    /**
     * @return string
     */
    public function getCallbackName(): string
    {
        return $this->callbackName;
    }

    /**
     * @return string
     */
    public function getCallbackParameter(): string
    {
        return $this->callbackParameter;
    }
}
