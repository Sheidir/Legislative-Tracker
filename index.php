<?php
require_once 'lib\common.php';
session_start();
$pdo = getPDO();
$sql = "SELECT COUNT(*) FROM bills";
$stmt = $pdo->prepare($sql);
$stmt->execute();
    $count = (int)$stmt->fetchColumn();
    $index = 0;


?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Heidi's Virginia Legislative Website Tracker</title>
    <?php require "templates/head.php" ?>
</head>

<body>
<?php require "templates/header.php" ?>


    <?php while($index < $count):?>
    <?php $offset = $index +99?>

    <a href = "list-bill.php?offset=<?php echo $index?>">See bills [<?php echo $index?>] - [<?php echo $offset?>]</a>
    <?php $index = $offset +1?>
<?endwhile ?>
</body>
</html>

