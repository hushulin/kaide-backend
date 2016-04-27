<?php

/**
 * Register System routes before all user routes.
 */
App::before(function ($request) {
    /*
     * Combine JavaScript and StyleSheet assets
     */
    Route::any('combine/{file}', 'System\Classes\Controller@combine');
});


Route::get('/sock' , function(){
	$sock = App::make('kaide.sock')->connect();

	$read = $sock->read();

	var_dump($read);

	var_dump($sock);
});
