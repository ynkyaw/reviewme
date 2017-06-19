<?php
namespace App\Shell;
use Cake\Console\Shell;
use Cake\Cache\Cache;

class HelloShell extends Shell
{
	public function main()
	{
		$this->out('Hello world.');
		Cache::clear(false,'long');
		$this->out('Cache is all clear.');
	}
	public function heyThere($name = 'Anonymous')
	{
		$this->out('Hey there ' . $name);
	}

}
?>