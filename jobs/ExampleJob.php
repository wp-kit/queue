<?php
namespace Bedrock\Jobs;
use WPKit\Queue\AbstractJob;
class ExampleJob extends AbstractJob
{
	
	protected $foo;
  
	public function __construct($foo) {
		$this->foo = $foo;
	}
	
	public function getFoo() {
		return $this->foo;
	}
	
	public function handle()
	{	
		echo $this->getFoo();
	}
  
}