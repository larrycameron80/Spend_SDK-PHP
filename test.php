<?php
include 'vendor/autoload.php';

use Ctk\CtkClient;

$client = new CtkClient('{ENDPOINT_URL}');

$accessToken = $client->user()
    ->select('accessToken')
    ->login('{username}', '{password}');

$clientMethods = $client->setAccessToken($accessToken);

print_r(



    $clientMethods->symbol()->list()



);


