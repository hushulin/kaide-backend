<?php
Route::get('/sock', function () {

    $sock = App::make('kaide.sock');

    $sock->connect();

    $buff = $sock->read();
    echo $buff;

    $sock->write("0000");

    $buff = $sock->read();
    echo $buff;

    $sock->close();
});
