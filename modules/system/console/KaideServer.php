<?php
namespace System\Console;
use Illuminate\Console\Command;
use System\Classes\UpdateManager;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Aysheka\Socket\Client;
use Aysheka\Socket\Type;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Aysheka\Socket\Event\SocketEvent;
use Aysheka\Socket\Server\Event\NewConnectionEvent;
use Aysheka\Socket\Event\Init\OpenEvent;
use Aysheka\Socket\Event\Init\CloseEvent;
use Aysheka\Socket\Client\Event\ConnectEvent;
use Aysheka\Socket\Server\Event\BindEvent;
use Aysheka\Socket\Event\IO\ReadEvent;
use Aysheka\Socket\Event\IO\WriteEvent;
use Log;

class KaideServer extends Command {
    /**
     * The console command name.
     */
    protected $name = 'kaide:server';
    /**
     * The console command description.
     */
    protected $description = 'Kaide socket server';
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

        $this->output->writeln('<info>Kaide server starting ... </info>');

        Log::info('!KAIDE:Kaide server starting ...');

        $eventDispatcher = new EventDispatcher();

        $eventDispatcher->addListener(NewConnectionEvent::getEventName(), function (NewConnectionEvent $event) {

            $socket = $event->getSocket();

            $socket->write("HELLO I'M KAIDE SERVER\n");

            // Read bytes from socket if available
            while ($read = $socket->read()) {

                $ascii = array();

                for ($i=0; $i < strlen($read); $i++) {
                    $ascii[] = bin2hex($read{$i});
                }

                //
                if ('01' == $ascii[1] ) {

                    $ascii[1] = 81;

                    $ascii[3] = 10;

                    for ($i=15; $i <= 20; $i++) {
                        unset($ascii[$i]);
                    }

                    $bin = array_reduce($ascii, function($v1 , $v2){
                        return $v1 . hex2bin($v2);
                    });

                    $socket->write($bin);

                }

                usleep(50);

                $tmp = "7b 89 00 12 31 35 38 32 31 30 34 39 37 33 34 03 03 7b";
                $arr_tmp = explode(" ", $tmp);
                $bin_tmp = array_reduce($arr_tmp, function($v1 , $v2){
                    return $v1 . hex2bin($v2);
                });
                $socket->write($bin_tmp);
                $socket->write($bin_tmp);
                $socket->write($bin_tmp);

                //
                usleep(50);
            }
        });


        $eventDispatcher->addListener(ReadEvent::getEventName(), function (ReadEvent $event) {

            $buffer = trim($event->getData());

            $ascii = array();

            for ($i=0; $i < strlen($buffer); $i++) {
                $ascii[] = bin2hex($buffer{$i});
            }
            Log::info( "REQUEST::" . $buffer );
            Log::info( "REQUEST(HEX)::" . join(" " , $ascii) );
        });

        $eventDispatcher->addListener(WriteEvent::getEventName(), function (WriteEvent $event) {

            $buffer = trim($event->getData());

            $ascii = array();

            for ($i=0; $i < strlen($buffer); $i++) {
                $ascii[] = bin2hex($buffer{$i});
            }
            Log::info( "RESPONSE::" . $buffer );
            Log::info( "RESPONSE(HEX)::" . join(" " , $ascii) );
        });

        $server = new \Aysheka\Socket\Server\Server('0.0.0.0', 8089, new \Aysheka\Socket\Address\IP4() , new Type\Stream() , new \Aysheka\Socket\Transport\TCP() , $eventDispatcher);

        $server->create(true);

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
