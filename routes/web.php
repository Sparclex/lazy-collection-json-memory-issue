<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\StreamedJsonResponse;

Route::get('/', function() {
   return view('welcome');
});

Route::get('/generator', function() {


    $getUsers = function() {
        foreach(User::cursor() as $user) {
            yield $user->id;
        }
    };

    $response  = response()->streamJson([
        'data' => $getUsers()
    ]);


    showMemoryUsage($response);
});
Route::get('/lazy-collection', function() {

    $response =  response()->streamJson([
        'data' => User::cursor()->map->id
    ]);

    showMemoryUsage($response);
});


function showMemoryUsage(StreamedJsonResponse $response): void {
    $usage = memory_get_usage();
    echo "<html>";
    echo "<pre>";
    $response->sendContent();
    echo "</pre>";
    $endUsage = memory_get_usage();
    echo "\n<p style='color: red; font-size: 18px;'>".  (($endUsage - $usage) / 1024)  . 'kb</p>';
    echo "</html>";
}
