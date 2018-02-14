<?php
require_once "lib/common.php";

$pdo = getPDO();
session_start();

if(isset($_GET['number'])){
    $number = $_GET['number'];
    if($_GET['action'] == 'track'){
        $action = true;

    }else{
        $action = false;
    }

}
else {
    redirectAndExit('index.php');

}

$sql = "UPDATE
'bills'
SET
is_tracked = :is_tracked
WHERE
number = :number
";

$stmt = $pdo->prepare($sql);

$stmt->execute(array('number' => $number, 'is_tracked' =>$action));
redirectAndExit('tracked.php');


