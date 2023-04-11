<?php
require_once 'vendor/autoload.php';
require_once 'api_request.php';
require_once 'sorting.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$servers = getServerData();

$euServers = $servers['eu'];
$naServers = $servers['na'];

$euServers = sortServersByPopulationAndAlphabet($euServers);
$naServers = sortServersByPopulationAndAlphabet($naServers);

echo $twig->render('index.twig', [
    'Eu' => $euServers,
    'Na' => $naServers,
]);
exit;