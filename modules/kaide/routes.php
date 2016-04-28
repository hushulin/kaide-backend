<?php
Route::get('/sock', function () {

    $sock = App::make('kaide.sock');

    $sock->connect();

    $sock->write('Request');
});
