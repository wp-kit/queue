<?php
namespace Theme\Jobs;
use WPKit\Queue\AbstractJob;
class ExampleJob extends AbstractJob
{
	
	protected $foo;
  
	public function __construct($foo) {
		$this->foo = $foo;
	}
	
	public function getDoo() {
		return $this->foo;
	}
  
}