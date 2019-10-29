<?php
namespace Theme\Jobs\Handlers;
use Theme\Jobs\ExampleJob;
use WPKit\Queue\AbstractHandler;
class ExampleJobHandler extends AbstractHandler
{
	
	public function handle(ExampleJob $message)
	{	
		echo $message->getFoo();
	}
	
}