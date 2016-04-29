<?php
namespace System\Console;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Log;

class KaideSwoole extends Command {
    /**
     * The console command name.
     */
    protected $name = 'kaide:swoole';
    /**
     * The console command description.
     */
    protected $description = 'Kaide socket swoole';
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
        $this->output->writeln('<info>Kaide swoole starting ... </info>');
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
