<?php
require __DIR__ . '/vendor/autoload.php';
include ('/src/vdo.php');
$vdo = new vdo;
$drive_link = 'https://docs.google.com/file/d/0B-sQqHvLCrsCVFhjUmpqRnFRV1E/preview';
$vdo->getLink($drive_link);
echo $vdo->getSources();

?>
