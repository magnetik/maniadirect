<?php

use Auryn\Injector;
use Maniaplanet\DedicatedServer\Connection;
use Nadeo\Live\ManiaDirect\Plugin\PluginInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ManiaDirect
{
    public function run()
    {
        $injector = new Injector();

        $config = [ //To be loaded by file/arguments
            'ip' => '127.0.0.1',
            'port' => 5000
        ];

        $pluginClasses = [ //To be loaded from elsewhere
            \Nadeo\Live\ManiaDirect\Core\CallbackDispatcher\CallbackDispatcherPlugin::class,
            \Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher\XmlrpcScriptCallbackDispatcherPlugin::class
        ];

        //Logs
        $logger = new \Monolog\Logger('main');
        $logger->pushHandler(new \Monolog\Handler\ErrorLogHandler());

        $injector->share($logger);
        $injector->alias(\Psr\Log\LoggerInterface::class, \Monolog\Logger::class);

        //XmlRpc connection
        $connection = Connection::factory($config['ip'], $config['port']);
        $connection->enableCallbacks();
        $injector->share($connection);

        //Event dispatcher
        /** @var \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher */
        $eventDispatcher = $injector->make(\Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher::class, ['dispatcher' => \Symfony\Component\EventDispatcher\EventDispatcher::class]);
        $injector->share($eventDispatcher);
        $injector->alias(\Symfony\Component\EventDispatcher\EventDispatcherInterface::class, \Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher::class);

        // Loading plugins
        foreach ($pluginClasses as $pluginClass) {
            $plugin = $injector->make($pluginClass);

            if (!$plugin instanceof PluginInterface) {
                throw new \InvalidArgumentException();
            }

            if ($plugin instanceof EventSubscriberInterface) {
                $eventDispatcher->addSubscriber($plugin);
            }
        }

        //Looping
        while (true) {
            $eventDispatcher->dispatch(\Nadeo\Live\ManiaDirect\Event\ManiaDirectEvents::LOOP);

            usleep(200000);
        }
    }
}
