<?php
Route::get('/sock' , function(){
	$sock = App::make('kaide.sock');

	var_dump($sock);

	var_dump($sock->connect());

	die();


	$read = $sock->read();

	var_dump($read);

	var_dump($sock);
});
