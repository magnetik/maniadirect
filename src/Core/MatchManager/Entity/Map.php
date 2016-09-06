<?php

namespace Nadeo\Live\ManiaDirect\Core\MatchManager\Entity;

class Map
{
    /**
     * @var integer
     */
    protected $index;

    /**
     * @var string
     */
    protected $uid;

    /**
     * @var bool
     */
    protected $restart;

    /**
     * @var Round[]
     */
    protected $rounds;

    public function __construct($index, $uid, $restart)
    {
        $this->index = $index;
        $this->uid = $uid;
        $this->restart = $restart;
    }

    public function addRound(Round $round)
    {
        $this->rounds[] = $round;
    }

    public function getCurrentRound()
    {
        return end($this->rounds);
    }
}
