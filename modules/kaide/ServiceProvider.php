<?php
namespace Kaide;
use October\Rain\Support\ModuleServiceProvider;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Aysheka\Socket\Client\Client;
use Aysheka\Socket\Address\IP4;
use Aysheka\Socket\Type\Stream;
use Aysheka\Socket\Transport\TCP;
use App;

class ServiceProvider extends ModuleServiceProvider {
    public function register() {
        parent::register('kaide');
        App::bind('kaide.sock', function () {

            return new Client('120.76.137.219', 8089, new IP4() , new Stream() , new TCP() , new EventDispatcher());
        });
    }
}
