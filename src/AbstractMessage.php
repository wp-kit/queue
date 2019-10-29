<?php
namespace WPKit\Queue;
use Bernard\Message;
abstract class AbstractMessage implements Message
{  
	

  public function getName()
  {
    return get_class($this);
  }
  
  
  public function getHanderClass()
  {
	  return str_replace(__NAMESPACE__, __NAMESPACE__ . '\Handlers', $this->getName()); 
  }
  
  public static function dispatch() {
	$job = new static(...func_get_args());
	app('queue')->dispatch($job);
  }

}