<?php

function getServerData() {
    $euServers = [];
    $naServers = [];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.guildwars2.com/v2/worlds?ids=all');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $serverData = json_decode($response, true);

    foreach ($serverData as $server) {
        if (substr($server['id'], 0, 1) === '2') {
            $euServers[] = $server;
        } else {
            $naServers[] = $server;
        }
    }

    return [
        'eu' => $euServers,
        'na' => $naServers,
    ];
}