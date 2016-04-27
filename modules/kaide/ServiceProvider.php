<?php
namespace Kaide;
use October\Rain\Support\ModuleServiceProvider;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Aysheka\Socket\Client\Client;
use Aysheka\Socket\Address\IP4;
use Aysheka\Socket\Type\Stream;
use Aysheka\Socket\Transport\TCP;

class ServiceProvider extends ModuleServiceProvider {
    public function register() {
        App::singleton('kaide.sock', function () {

            return new Client('127.0.0.1', 8089, new IP4() , new Stream() , new TCP() , new EventDispatcher());
        });
    }
}
