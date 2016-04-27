<?php
Route::get('/sock' , function(){
	$sock = App::make('kaide.sock')->connect();

	$read = $sock->read();

	var_dump($read);

	var_dump($sock);
});
