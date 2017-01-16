<?php
require __DIR__ . '/vendor/autoload.php';
include ('/src/vdo.php');
$vdo = new vdo;
$drive_link = 'https://drive.google.com/file/d/0BwVFSukmoYZTWVhqTG5NRzNOR0E/view';
$vdo->getLink($drive_link);
echo $vdo->getSources();

?>
