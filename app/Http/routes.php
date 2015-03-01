<?php

Route::get('{data?}', function()
{
	return View::make('app');
})->where('data', '.*');