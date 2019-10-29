<?php
use Bernard\Router\ClassNameRouter;
use Bernard\Consumer;
use Bernard\Queue\RoundRobinQueue;
use Bernard\Message;
use Symfony\Component\EventDispatcher\EventDispatcher;
use WPKit\Queue\Queue;
use Roots\WPConfig\Config;

/** WordPress view bootstrapper */
define('WP_CONSOLE', true);
define('WP_ENV', 'console');
require_once dirname(__DIR__) . '/config/application.php';

$queue = new Queue();

$queueFactory = $queue->getFactory();

$router = new ClassNameRouter();
$router->add(Message::class, function(Message $message) {
    $handlerClass = $message->getHanderClass();
    $handler = new $handlerClass;
    $handler->handle($message);
});
$queues = array_map(
    function ($queueName) use ($queueFactory) {
      return $queueFactory->create($queueName);
    },
    explode(',', Config::get('QUEUES'))
);
$eventDispatcher = new EventDispatcher();
$eventDispatcher->addListener(
    Bernard\BernardEvents::INVOKE,
    function(Bernard\Event\EnvelopeEvent $envelopeEvent) {
        $queue->log('Processing: ' . $envelopeEvent->getEnvelope()->getClass()); 
    }
);
$eventDispatcher->addListener(
    Bernard\BernardEvents::ACKNOWLEDGE,
    function(Bernard\Event\EnvelopeEvent $envelopeEvent) {
        $queue->log('Processed: ' . $envelopeEvent->getEnvelope()->getClass());
    }
);
$eventDispatcher->addListener(
    Bernard\BernardEvents::REJECT,
    function(Bernard\Event\RejectEnvelopeEvent $envelopeEvent) {
        $queue->log('Failed: ' . $envelopeEvent->getEnvelope()->getClass());
    }
);
// Create a Consumer and start the loop.
$consumer = new Consumer($router, $eventDispatcher);
$consumer->consume(new RoundRobinQueue($queues));