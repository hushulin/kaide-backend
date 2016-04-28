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


        $eventDispatcher->addListener(ReadEvent::getEventName() , function (ReadEvent $event) {
            // echo "Read: " . trim($event->getData()) . "\n";
            // Log::info("!KAIDE:Read: " . trim($event->getData()) . "\n");

            $buffer = $event->getData();

            for ($i=0; $i < strlen($buffer); $i++) {
                Log::info(ord($buffer{$i}));
            }

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
