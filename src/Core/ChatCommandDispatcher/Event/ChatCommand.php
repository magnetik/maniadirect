<?php

namespace Nadeo\Live\ManiaDirect\Core\ChatCommandDispatcher\Event;

use Nadeo\Live\ManiaDirect\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class ChatCommand extends Event implements EventInterface
{
    /**
     * @var string
     */
    protected $commandName;

    /**
     * @var array
     */
    protected $arguments;

    public function __construct($commandName, array $arguments)
    {
        $this->commandName = $commandName;
        $this->arguments = $arguments;
    }

    public function getName()
    {
        return sprintf('chat_command.%s', $this->commandName);
    }

    public function getArgument()
    {
        $this->arguments;
    }
}
