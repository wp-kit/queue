<?php
namespace WPKit\Queue;
use Bernard\Message;
abstract class AbstractJob implements Message
{  
	protected $queue;
	
  	public function getName()
	{
		return get_class($this);
	}
	
	public function wp() {
		if(!defined('WP_USE_THEMES')) {
			define( 'WP_USE_THEMES', false );
		}
		require_once 'web/wp/wp-blog-header.php';
	}
	
	public function handle() {
		
	}
	
	public static function dispatch() {
		$job = new static(...func_get_args());
		$job->setQueue(app('queue'));
		$job->getQueue()->dispatch($job);
	}
	
	public static function trigger() {
		$job = new static(...func_get_args());
		$job->setQueue(app('queue'));
		$job->handle();
	}
	
	public function setQueue($queue) {
		$this->queue = $queue;
	}
	
	public function getQueue() {
		return $this->queue;
	}
	
	public function log($message) {
		$this->getQueue()->log($message);
	}

}