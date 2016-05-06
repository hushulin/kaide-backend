<?php
namespace System\Console;
use Illuminate\Console\Command;
use System\Classes\UpdateManager;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Log;
use Cache;

class KaideTask extends Command {
    /**
     * The console command name.
     */
    protected $name = 'kaide:task';
    /**
     * The console command description.
     */
    protected $description = 'Kaide socket task';
    /**
     * Create a new command instance.
     */
    public function __construct() {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function fire() {
        $this->output->writeln('<info>Kaide task starting ... </info>');

        while (1) {
        	$serv = Cache::get('serv');
	        $fd = Cache::get('fd');
	        $fd = explode(',', $fd);
	        foreach ($fd as $key => $value) {
	        	try {
	        		$serv->send($value , '99');
	        	} catch (Exception $e) {
	        		continue;
	        	}

	        }
	        sleep(5);
        }

    }
    /**
     * Get the console command arguments.
     */
    protected function getArguments() {

        return [];
    }
    /**
     * Get the console command options.
     */
    protected function getOptions() {

        return [];
    }
}
