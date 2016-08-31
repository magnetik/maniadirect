<?php

namespace Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\Event;

use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class PlayerChat extends Event implements EventInterface
{
    /**
     * @var integer
     */
    protected $playerUid;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var boolean
     */
    protected $registeredCommand;

    public function __construct(array $parameters)
    {
        $this->playerUid = intval($parameters[0]);
        $this->login = $parameters[1];
        $this->text = $parameters[2];
        $this->registeredCommand = boolval($parameters[3]);
    }

    public function getName()
    {
        return CallbackDispatcherEvents::PLAYER_CHAT;
    }

    /**
     * @return mixed
     */
    public function getPlayerUid()
    {
        return $this->playerUid;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * True if the text starts with /
     *
     * @return bool
     */
    public function isRegisteredCommand()
    {
        return $this->registeredCommand;
    }
}
