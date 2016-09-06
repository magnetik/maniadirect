<?php

namespace Nadeo\Live\ManiaDirect\Core\MatchManager\Entity;

class Match
{
    /**
     * @var integer
     */
    protected $index;

    /**
     * @var Map[]
     */
    protected $maps;

    /**
     * @var \DateTimeImmutable
     */
    protected $startedOn;

    public function __construct($index)
    {
        $this->index = $index;
        $this->startedOn = new \DateTimeImmutable();
    }

    public function addMap(Map $map)
    {
        $this->maps[] = $map;
    }

    public function getCurrentMap()
    {
        return end($this->maps);
    }

    public function getIndex(): int
    {
        return $this->index;
    }
}
