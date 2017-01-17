<?php
require __DIR__ . '/vendor/autoload.php';
use \Xbxcj\vdo;
$vdo = new vdo;
$drive_link = 'https://drive.google.com/open?id=0B9MrTPFsRfUgUDBKdTg5Y0taQ3M';
$vdo->getLink($drive_link);
echo $vdo->getSources();

?>
