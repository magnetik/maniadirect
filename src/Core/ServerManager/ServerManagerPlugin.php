<?php

namespace Nadeo\Live\ManiaDirect\Core\ServerManager;

use Nadeo\Live\ManiaDirect\Plugin\PluginInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Handle the current state of server (login, players, mode, etc.)
 */
class ServerManagerPlugin implements PluginInterface, EventSubscriberInterface 
{
    public static function getSubscribedEvents()
    {
        return [];
    }

    public function getPrefix()
    {
        return 'server';
    }
}
