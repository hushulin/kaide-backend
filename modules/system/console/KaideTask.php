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
            // $serv = Cache::get('serv');
            // Get the file token key
            $key = ftok(__DIR__, 'a');
            // Fetch serv length
            $length = 1024;
            // 创建一个共享内存
            $shm_id = shm_attach($key, $length, 777); // resource type
            if ($shm_id === false) {
                die('Unable to create the shared memory segment');
            }

            $fd = Cache::get('fd');
            $fd = explode(',', $fd);

            foreach ($fd as $key => $value) {
                $serv = shm_get_var($shm_id, $value);
                try {
                    $serv->send($value, '99');
                }
                catch(ErrorException $e) {
                    continue;
                }

            }

            shm_detach($shm_id);
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
