<?php

namespace Nadeo\Live\ManiaDirect\Core\CallbackDispatcher;

use Maniaplanet\DedicatedServer\Connection;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Nadeo\Live\ManiaDirect\Event\ManiaDirectEvents;
use Nadeo\Live\ManiaDirect\Plugin\PluginInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Dispatch Xmlrpc callbacks as events
 */
class CallbackDispatcherPlugin implements PluginInterface, EventSubscriberInterface
{
    private $connection;

    private $eventDispatcher;

    public function __construct(Connection $connection, EventDispatcherInterface $eventDispatcher)
    {
        $this->connection = $connection;
        $this->eventDispatcher = $eventDispatcher;
    }

    public static function getSubscribedEvents()
    {
        return [
            ManiaDirectEvents::LOOP => ['onLoop', 500]
        ];
    }

    public function onLoop($event)
    {
        $callbacks = $this->connection->executeCallbacks();

        foreach($callbacks as $callback) {
            $callbackName = $callback[0];
            $callbackParameters = $callback[1];

            switch ($callbackName) {
                case 'ManiaPlanet.BeginMap':
                    $event = new Event\BeginMap($callbackParameters);
                    break;

                case 'ManiaPlanet.BeginMatch':
                    $event = new Event\BeginMatch();
                    break;

                case 'ManiaPlanet.PlayerChat':
                    $event = new Event\PlayerChat($callbackParameters);
                    break;

                case 'ManiaPlanet.ModeScriptCallback':
                    $event = new Event\ModeScriptCallback($callbackParameters);
                    break;

                case 'ManiaPlanet.ModeScriptCallbackArray':
                    $event = new Event\ModeScriptCallbackArray($callbackParameters);
                    break;

                default:
                    continue 2;
            }

            $this->dispatchEvent($event);
        }
    }

    public function dispatchEvent(EventInterface $event)
    {
        $this->eventDispatcher->dispatch($event->getName(), $event);
    }
}
