<?php

namespace Nadeo\Live\ManiaDirect\Core\MatchManager;

use Nadeo\Live\ManiaDirect\Core\MatchManager\Entity\Map;
use Nadeo\Live\ManiaDirect\Core\MatchManager\Entity\Match;
use Nadeo\Live\ManiaDirect\Core\MatchManager\Entity\Round;
use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\Event\BeginMap;
use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\Event\BeginMatch;
use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\Event\BeginRound;
use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\Event\EndMatch;
use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\Event\EndRound;
use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\XmlrpcScriptCallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Plugin\PluginInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MatchManagerPlugin implements PluginInterface, EventSubscriberInterface
{
    /**
     * @var Match[]
     */
    protected $matches;

    /**
     * @var int
     */
    protected $currentMatchIndex;

    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function getPrefix()
    {
        return 'match';
    }

    public static function getSubscribedEvents()
    {
        return [
            XmlrpcScriptCallbackDispatcherEvents::BEGIN_MATCH => 'onBeginMatch',
            XmlrpcScriptCallbackDispatcherEvents::BEGIN_MAP => 'onBeginMap',
            XmlrpcScriptCallbackDispatcherEvents::BEGIN_ROUND => 'onBeginRound',
            XmlrpcScriptCallbackDispatcherEvents::END_MATCH => 'onEndMatch',
            XmlrpcScriptCallbackDispatcherEvents::END_MAP => 'onEndMatch',
            XmlrpcScriptCallbackDispatcherEvents::END_ROUND => 'onEndRound',
        ];
    }

    public function getCurrentMatch()
    {
        return $this->matches[$this->currentMatchIndex];
    }

    public function onBeginMatch(BeginMatch $event)
    {
        $index = $event->getIndex();

        $this->currentMatchIndex = $index;

        if (isset($this->matches[$index])) {
            //TODO: is this a restart or something ?
        }

        $this->matches[$index] = new Match($index);
    }

    public function onBeginMap(BeginMap $beginMap)
    {
        $map = new Map($beginMap->getMapIndex(), $beginMap->getMapUid(), $beginMap->isRestarted());

        $this->getCurrentMatch()->addMap($map);
    }

    public function onBeginRound(BeginRound $beginRound)
    {
        $round = new Round($beginRound->getIndex());

        $this->getCurrentMatch()->getCurrentMap()->addRound($round);
    }

    public function onEndRound(EndRound $endRound)
    {
        $currentRound = $this->getCurrentMatch()->getCurrentMap()->getCurrentRound();

        if ($currentRound->getIndex() != $endRound->getIndex()) {
            throw new \InvalidArgumentException();
        }

        $currentRound->setFinished();
    }

    public function onEndMatch(EndMatch $endMatch)
    {
        var_dump($this->getCurrentMatch());
    }
}
