<?php
require_once "lib/common.php";
session_start();
$pdo = getPDO();
$offset= 0;
if(isset($_GET['offset'])){
    $offset = $_GET['offset'];
}
$sql = "
SELECT
*
FROM
'bills'
LIMIT 50 OFFSET " . $offset
;
$stmt = $pdo->prepare($sql);
$stmt->execute();

$bills = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<table>
<?php foreach ($bills as $bill): ?>
<tr>
    <td><?php echo htmlEscape($bill['title'])?></td>
    <td><?php echo htmlEscape($bill['number'])?></td>
    <td><a href ="track-bill.php?number=<?php echo $bill['number']?>&amp;action='track'">Track Bill</a></td>
    <td><a href = "view-bill.php?number=<?php echo $bill['number']?> ">Read More</a></td>
</tr>
    <?php endforeach ?>
</table>
</body>
</html>


