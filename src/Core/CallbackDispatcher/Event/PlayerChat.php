<?php

namespace Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\Event;

use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class PlayerChat extends Event implements EventInterface
{
    public $playerUid;

    public $login;

    public $text;

    public function __construct(array $parameters)
    {
        $this->playerUid = $parameters[0];
        $this->login = $parameters[1];
        $this->text = $parameters[2];
    }

    public function getName()
    {
        return CallbackDispatcherEvents::PLAYER_CHAT;
    }
}
