<?php

namespace Nadeo\Live\ManiaDirect\Core\ServerManager\Entity;

use Maniaplanet\DedicatedServer\Connection;

/**
 * Represent the current state of the server
 */
class Server
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var Player[]
     */
    private $players;

    /**
     * @var bool
     */
    private $scriptInfoLoaded = false;

    /**
     * @var bool
     */
    private $systemInfoLoaded = false;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $script;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getLogin()
    {
        $this->loadSystemInfo();

        return $this->login;
    }

    public function getScript()
    {
        $this->loadScriptInfo();

        return $this->script;
    }

    private function loadSystemInfo()
    {
        if ($this->systemInfoLoaded === true) {
            return;
        }

        $systemInfo = $this->connection->getSystemInfo();

        $this->login = $systemInfo->serverLogin;

        $this->systemInfoLoaded = true;
    }

    private function loadScriptInfo()
    {
        if ($this->scriptInfoLoaded === true) {
            return;
        }

        $scriptInfo = $this->connection->getModeScriptInfo();

        $this->script = $scriptInfo->name;

        $this->scriptInfoLoaded = true;
    }

}
