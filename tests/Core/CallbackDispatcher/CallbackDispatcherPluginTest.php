<?php

namespace Nadeo\Live\ManiaDirect\Tests\Core\CallbackDispatcher;

use Maniaplanet\DedicatedServer\Connection;
use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherEvents;
use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherPlugin;
use Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\Event\ModeScriptCallbackArray;
use Nadeo\Live\ManiaDirect\Event\ManiaDirectEvents;
use Nadeo\Live\ManiaDirect\Tests\Core\Utils\TestEventListener;
use Symfony\Component\EventDispatcher\EventDispatcher;

class CallbackDispatcherPluginTest extends \PHPUnit_Framework_TestCase
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
     * @var CallbackDispatcherPlugin
     */
    private $callbackDispatcherPlugin;

    public function setup()
    {
        $this->eventDispatcher = new EventDispatcher();
        $this->connection = $this->getMockBuilder(Connection::class)->disableOriginalConstructor()->getMock();
        $this->callbackDispatcherPlugin = new CallbackDispatcherPlugin($this->connection, $this->eventDispatcher);
        $this->eventDispatcher->addSubscriber($this->callbackDispatcherPlugin);
    }

    public function testModeScriptCallbackArrayDispatched()
    {
        $listener = new TestEventListener();

        $this->eventDispatcher->addListener(CallbackDispatcherEvents::MODE_SCRIPT_CALLBACK_ARRAY, array($listener, 'onModeScriptCallbackArray'));

        $this->connection
            ->expects($this->once())
            ->method('executeCallbacks')
            ->willReturn([
                [
                    "ManiaPlanet.ModeScriptCallbackArray",
                    [
                        "Parameter",
                        [
                            "Value",
                            "Value2"
                        ]
                    ]
                ]
            ]);

        $this->callbackDispatcherPlugin->onLoop(ManiaDirectEvents::LOOP);
        $calls = $listener->getCalls();

        $this->assertCount(1, $calls);
        $this->assertEquals('onModeScriptCallbackArray', $calls[0]["methodName"]);
        $this->assertInstanceOf(ModeScriptCallbackArray::class, $calls[0]["arguments"][0]);
        $this->assertEquals("Parameter", $calls[0]["arguments"][0]->getCallbackName());
        $this->assertCount(2, $calls[0]["arguments"][0]->getCallbackParameters());
    }
}

