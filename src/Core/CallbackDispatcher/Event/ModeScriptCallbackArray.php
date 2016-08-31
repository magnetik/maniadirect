<?php

namespace Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\Event;

use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class ModeScriptCallbackArray extends Event implements EventInterface
{
    /**
     * @var string
     */
    private $callbackName;

    /**
     * @var array
     */
    private $callbackParameters;

    public function __construct(array $parameters)
    {
        $this->callbackName = $parameters[0];
        $this->callbackParameters = $parameters[1];
    }

    public function getName()
    {
        return CallbackDispatcherEvents::MODE_SCRIPT_CALLBACK_ARRAY;
    }

    /**
     * @return string
     */
    public function getCallbackName(): string
    {
        return $this->callbackName;
    }

    /**
     * @return array
     */
    public function getCallbackParameters(): array
    {
        return $this->callbackParameters;
    }
}
