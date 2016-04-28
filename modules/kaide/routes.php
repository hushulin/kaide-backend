<?php
Route::get('/sock', function () {
    $sock = App::make('kaide.sock');
    $sock->connect();
    $sock->read();
    $sock->write('Request');
    $sock->read();
    $sock->close();
});
