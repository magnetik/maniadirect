<?php

namespace Nadeo\Live\ManiaDirect\Core\ChatCommandDispatcher;

use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\Event\PlayerChat;
use Nadeo\Live\ManiaDirect\Core\ChatCommandDispatcher\Event\ChatCommand;
use Nadeo\Live\ManiaDirect\Plugin\PluginInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ChatCommandDispatcherPlugin implements PluginInterface, EventSubscriberInterface
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function getPrefix()
    {
        return 'chat_command';
    }

    public static function getSubscribedEvents()
    {
        return [
            CallbackDispatcherEvents::PLAYER_CHAT => ['onPlayerChat', 500]
        ];
    }

    public function onPlayerChat(PlayerChat $event)
    {
        if ($event->isRegisteredCommand() === false) {
            return;
        }

        //TODO: find something wiser to get arguments, including support for quotes
        $arguments = explode(' ', substr($event->getText(), 1));

        $event = new ChatCommand($arguments[0], array_slice($arguments, 1));

        $this->eventDispatcher->dispatch($event->getName(), $event);
    }
}
