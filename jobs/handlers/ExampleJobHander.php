<?php
namespace Theme\Jobs\Handlers;
use Theme\Jobs\ExampleJob;
class ExampleJobHandler
{
	
	public function handle(ExampleJob $message)
	{	
		echo $message->getFoo();
	}
	
}