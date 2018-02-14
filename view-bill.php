<?php
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
$response = json_decode($response, true);

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<?php foreach ($response as $item): ?>
<div>
    <?php echo $item ?>

</div>
<?php endforeach ?>
</body>
</html>
