<?php
require_once 'lib/common.php';
$pdo = getPDO();

session_start();

$sql = "SELECT *
FROM
'bills'
WHERE
is_tracked = :is_tracked";

$stmt = $pdo->prepare($sql);
$stmt->execute(array('is_tracked' => true));
$bills = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tracked Bills</title>
    <?php require "templates/head.php" ?>
</head>
<body>
<?php require "templates/header.php" ?>
<table>
<?php foreach ($bills as $bill): ?>
<tr>
    <td><?php echo $bill['number'] ?></td>
    <td> <?php echo $bill['title'] ?> </td>
    <td><a href="view-bill.php?number=<?php echo $bill['number']?>">View</a></td>
    <td><a href="track-bill.php?number=<?php echo $bill['number']?>&amp;action='untrack">Remove from tracking</a></td>
</tr>

<?php endforeach ?>
</table>
</body>
</html>
