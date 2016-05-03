<?php
namespace System\Console;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Log;
use swoole_server;

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

        $serv = new swoole_server("0.0.0.0", 8089);

        $serv->set(array(
            'worker_num' => 8, //工作进程数量
            'daemonize' => true, //是否作为守护进程

        ));

        // $serv->on('connect', function ($serv, $fd) {
        //     echo "Client:Connect.\n";
        // });

        $serv->on('receive', function ($serv, $fd, $from_id, $data) {

        	$ascii = array();

            for ($i=0; $i < strlen($data); $i++) {
                $ascii[] = bin2hex($data{$i});
            }

            Log::info("receive:" . join(" " , $ascii));

            if ( '01' == $ascii[1] ) {

                $ascii[1] = 81;

                $ascii[3] = 10;

                for ($i=15; $i <= 20; $i++) {
                    unset($ascii[$i]);
                }

                $bin = array_reduce($ascii, function($v1 , $v2){
                    return $v1 . hex2bin($v2);
                });

                $serv->send($fd , $bin);


                Log::info("send:" . join(" " , $ascii));
            }

            // This is a test send
            if ( '66' == $ascii[1] ) {
            	$serv->send($fd , '66');
            }

            // This is a other test send
            if ( '67' == $ascii[1] ) {
                $serv->send($fd , '67');
            }

            // if receive an exit code , close the fd;
            if ( 'exit' == $data ) {
                $serv->close($fd);
            }


            // $serv->close($fd);
        });

        // $serv->on('close', function ($serv, $fd) {
        //     echo "Client: Close.\n";
        // });

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
