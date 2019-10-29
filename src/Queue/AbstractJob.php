<?php
namespace WPKit\Queue;
use Bernard\Message;
use WPKit\Queue\Queue;
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
		app('queue')->dispatch($job);
	}
	
	public function setQueue(Queue $queue) {
		$this->queue = $queue;
	}
	
	public function log($message) {
		$this->queue->log($message);
	}

}