<?php

namespace Nadeo\Live\ManiaDirect\Tests\Core\XmlrpcScriptCallbackDispatcher;

use Maniaplanet\DedicatedServer\Connection;
use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\Event\ModeScriptCallbackArray;
use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\Event\BeginMap;
use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\XmlrpcScriptCallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\XmlrpcScriptCallbackDispatcherPlugin;
use Nadeo\Live\ManiaDirect\Tests\Core\Utils\TestEventListener;
use Symfony\Component\EventDispatcher\EventDispatcher;

class XmlrpcScriptCallbackDispatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $connection;

    /**
     * @var XmlrpcScriptCallbackDispatcherPlugin
     */
    private $callbackDispatcherPlugin;

    /**
     * @var TestEventListener;
     */
    private $listener;

    public function setup()
    {
        $this->eventDispatcher = new EventDispatcher();
        $this->connection = $this->getMockBuilder(Connection::class)->disableOriginalConstructor()->getMock();
        $this->callbackDispatcherPlugin = new XmlrpcScriptCallbackDispatcherPlugin($this->connection, $this->eventDispatcher);
        $this->listener = new TestEventListener();

        $this->eventDispatcher->addListener(XmlrpcScriptCallbackDispatcherEvents::BEGIN_MAP, array($this->listener, 'onBeginMap'));
        $this->eventDispatcher->addSubscriber($this->callbackDispatcherPlugin);
    }

    public function testBeginMapDispatched()
    {
        $parameters = [
           "LibXmlRpc_BeginMap",
            [
                1,
                "abcd",
                "false"
            ]
        ];

        $this->eventDispatcher->dispatch(CallbackDispatcherEvents::MODE_SCRIPT_CALLBACK_ARRAY, new ModeScriptCallbackArray($parameters));

        $calls = $this->listener->getCalls();

        $this->assertCount(1, $calls);
        $this->assertEquals("onBeginMap", $calls[0]["methodName"]);
        $this->assertInstanceOf(BeginMap::class, $calls[0]["arguments"][0]);
        $this->assertEquals($parameters[1][0], $calls[0]["arguments"][0]->getMapIndex());
        $this->assertEquals($parameters[1][1], $calls[0]["arguments"][0]->getMapUid());
    }
}
