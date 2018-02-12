<?php
require_once 'lib/common.php';
require_once 'lib/install.php';

$pdo = getPDO();

$error = installBlog($pdo);
if(!$error) {
    getAPI($pdo);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Heidi's Virginia Legislative Website Tracker</title>
</head>
<body>
<?php if($error): ?>
<p> <?php echo $error ?></p>
<?php else: ?>
<p> install maybe happened ok</p>
<?php endif ?>

</body>
</html>

