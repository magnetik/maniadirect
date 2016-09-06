<?php

namespace Nadeo\Live\ManiaDirect\Core\MatchManager\Entity;

class Round
{
    /**
     * @var integer
     */
    protected $index;

    /**
     * @var boolean
     */
    protected $finished;

    public function __construct($index)
    {
        $this->index = $index;
        $this->turns = [];
        $this->finished = false;
    }

    public function isFinished()
    {
        return $this->finished;
    }

    public function setFinished()
    {
        $this->finished = true;
    }

    public function getIndex(): int
    {
        return $this->index;
    }
}
