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
            //////////////////////////////////////////////////
        	$ascii = array();

            for ($i=0; $i < strlen($data); $i++) {
                $ascii[] = bin2hex($data{$i});
            }

            Log::info("receive:" . join(" " , $ascii));

            //////////////////////////////////////////////////
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

                sleep(5);

                $tmp = "7b 89 00 12 31 35 38 32 31 30 34 39 37 33 34 01 01 7b";
                //     "7b 89 00 12 31 35 38 32 31 30 34 39 37 33 34 01 01 7b"
                // $tmp = "fe fe fe fe fe 68 10 aa aa aa aa aa aa aa 03 03 81 0a 01 b0 16";

                // $tmp = "7b 81 00 1e 31 35 38 32 31 30 34 39 37 33 34 " . $tmp . " 7b";

                // $tmp = "7b 09 00 25 31 35 38 32 31 30 34 39 37 33 34 fe fe fe fe fe 68 10 aa aa aa aa aa aa aa 03 03 81 0a 01 b0 16 7b";
                $arr_tmp = explode(" ", $tmp);
                $bin_tmp = array_reduce($arr_tmp, function($v1 , $v2){
                    return $v1 . hex2bin($v2);
                });

                $serv->send($fd , $bin_tmp);
                Log::info("send:" . join(" " , $arr_tmp));


            }




            //////////////////////////////////////////////////
            // This is a test send
            if ( '66' == $ascii[1] ) {
            	$serv->send($fd , '66');
            }

            // This is a other test send
            if ( '67' == $ascii[1] ) {
                $serv->send($fd , '67');
            }
            //////////////////////////////////////////////////
            // if receive an exit code , close the fd;
            if ( 'exit' == $data ) {
                $serv->close($fd);
            }
            //////////////////////////////////////////////////
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
