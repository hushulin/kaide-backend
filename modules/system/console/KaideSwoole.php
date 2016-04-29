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
        $serv = new swoole_server("0.0.0.0", 9501);
        $serv->set(array(
            'worker_num' => 8, //工作进程数量
            'daemonize' => true, //是否作为守护进程

        ));
        $serv->on('connect', function ($serv, $fd) {
            echo "Client:Connect.\n";
        });
        $serv->on('receive', function ($serv, $fd, $from_id, $data) {
            $serv->send($fd, 'Swoole: ' . $data);
            $serv->close($fd);
        });
        $serv->on('close', function ($serv, $fd) {
            echo "Client: Close.\n";
        });
        $serv->start();
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
