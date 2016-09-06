<?php

namespace Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher;

use Maniaplanet\DedicatedServer\Connection;
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
    private $connection;

    private $eventDispatcher;

    public function __construct(Connection $connection, EventDispatcherInterface $eventDispatcher)
    {
        $this->connection = $connection;
        $this->eventDispatcher = $eventDispatcher;

        $connection->setModeScriptSettings(['S_UseScriptCallbacks' => true]);
    }

    public function getPrefix()
    {
        return 'xmlrpc';
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

            case 'LibXmlRpc_BeginMatch':
                $event = new Event\BeginMatch($parameters);
                break;

            case 'LibXmlRpc_BeginMap':
                $event = new Event\BeginMap($parameters);
                break;

            case 'LibXmlRpc_BeginRound':
                $event = new Event\BeginRound($parameters);
                break;

            case 'LibXmlRpc_BeginTurn':
                $event = new Event\BeginTurn($parameters);
                break;

            case 'LibXmlRpc_EndMatch':
                $event = new Event\EndMatch($parameters);
                break;

            case 'LibXmlRpc_EndRound':
                $event = new Event\EndRound($parameters);
                break;

            case 'LibXmlRpc_EndMap':
                $event = new Event\EndMap($parameters);
                break;

            case 'LibXmlRpc_EndTurn':
                $event = new Event\EndTurn($parameters);
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
