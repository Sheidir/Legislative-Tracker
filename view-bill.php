<?php
require_once "lib/common.php";
session_start();
$number = "hb1";
if(isset($_GET['number'])){
    $number = $_GET['number'];
}
$url = "http://api.richmondsunlight.com/1.0/bill/2018/" . $number . ".json";

$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);
    $response = file_get_contents($url, false, stream_context_create($arrContextOptions));
    $error = null;
    if(!$response){
        $error = "Bill ". htmlEscape($number) . " not found. Please search again.";

    }

$response = json_decode($response, true);

?>
<!DOCTYPE html>
<html>
<head>
    <title>View bill <?php echo $number ?></title>
<?php require 'templates/head.php'?>
</head>
<body>
<?php require 'templates/header.php' ?>
<?php if ($error): ?>
    <h1><?php echo $error ?></h1>
<?php else: ?>
<h1><?php echo $number ?> <?php echo $response['title'] ?></h1>
    <a href = "track-bill.php?number=<?php echo $number?>&amp;action=track">Track this bill</a>
<h2>History</h2>
<?php require 'lib/scraper.php' ?>
<?php foreach ($response as $item): ?>
<div>
   <?php echo $item ?>
</div>
<?php endforeach ?>
<?php endif ?>
</body>
</html>
