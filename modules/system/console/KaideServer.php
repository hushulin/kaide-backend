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

            $socket->write("HELLO I'm test server\n");

            // Read bytes from socket if available
            while ($read = $socket->read()) {
                echo "Read data: [{$read}]";
                $socket->write('Response');
                usleep(50);
            }
        });

        $eventDispatcher->addListener(OpenEvent::getEventName(), function (OpenEvent $event) {
            echo "Open\n";
        });

        $eventDispatcher->addListener(CloseEvent::getEventName(), function (CloseEvent $event) {
            echo "Close\n";
        });

        $eventDispatcher->addListener(ConnectEvent::getEventName(), function (ConnectEvent $event) {
            echo "Connect\n";
        });

        $eventDispatcher->addListener(BindEvent::getEventName(), function (BindEvent $event) {
            echo "Bind\n";
        });

        $eventDispatcher->addListener(ReadEvent::getEventName(), function (ReadEvent $event) {
            echo "Read: " . trim($event->getData()) . "\n";

            $buffer = $event->getData();

            $ascii = "";

            for ($i=0; $i < strlen($buffer); $i++) {
                $ascii .= ord($buffer{$i});
            }

            Log::info($ascii);

        });

        $eventDispatcher->addListener(WriteEvent::getEventName(), function (WriteEvent $event) {
            echo "Write: " . trim($event->getData()) . "\n";
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
