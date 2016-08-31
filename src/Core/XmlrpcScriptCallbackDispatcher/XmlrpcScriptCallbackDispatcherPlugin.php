<?php

namespace Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher;

use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\Event\ModeScriptCallbackArray;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Nadeo\Live\ManiaDirect\Plugin\PluginInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Dispatch XMLRPC Script callbacks as event
 */
class XmlrpcScriptCallbackDispatcherPlugin implements PluginInterface, EventSubscriberInterface
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public static function getSubscribedEvents()
    {
        return [
            CallbackDispatcherEvents::MODE_SCRIPT_CALLBACK => ['onModeScriptCallback', 500],
            CallbackDispatcherEvents::MODE_SCRIPT_CALLBACK_ARRAY => ['onModeScriptCallbackArray', 500]
        ];
    }

    public function onModeScriptCallback($event)
    {
    }

    public function onModeScriptCallbackArray(ModeScriptCallbackArray $event)
    {
        $parameters = $event->getCallbackParameters();

        switch ($event->getCallbackName()) {
            case 'LibXmlRpc_LoadingMap':
                $event = new Event\BeginMap($parameters);
                break;

            case 'LibXmlRpc_OnHit':
                $event = new Event\OnHit($parameters);
                break;

            default:
                return;
        }

        $this->dispatchEvent($event);
    }

    public function dispatchEvent(EventInterface $event)
    {
        $this->eventDispatcher->dispatch($event->getName(), $event);
    }
}
