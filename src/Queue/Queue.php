<?php
	
namespace WPKit\Queue;

use Bernard\Driver\PredisDriver;
use Bernard\Normalizer\EnvelopeNormalizer;
use Bernard\QueueFactory\PersistentFactory;
use Normalt\Normalizer\AggregateNormalizer;
use Predis\Client;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Bernard\Producer;
use Bernard\Serializer;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Queue {
	
	protected $factory;
	
	public function getFactory() {
		
		if( ! $this->factory ) {
		
			$predis = new Client('tcp://localhost', array(
			    'prefix' => 'bernard:',
			));
			$driver = new PredisDriver($predis);
			
			$this->factory = new PersistentFactory(
			    $driver,
			    new Serializer(
			        new AggregateNormalizer([
			            new EnvelopeNormalizer(),
			            new \Symfony\Component\Serializer\Serializer(
			                [new ObjectNormalizer()],
			                [new JsonEncoder()]
			            ),
			        ])
			    )
			);
		
		}
		
		return $this->factory;
		
	}
	
	public function dispatch($job) {
		
		$eventDispatcher = new EventDispatcher();
		$producer = new Producer($this->getFactory(), $eventDispatcher);
		$producer->produce($job, 'default');
		
	}
	
	public function log($message) {
		file_put_contents(ROOT_DIR . '/logs/queue_'.date("j.n.Y").'.log', PHP_EOL . date("Y-m-d H:i:s") . ' ' . $message, FILE_APPEND);
	}

	
}