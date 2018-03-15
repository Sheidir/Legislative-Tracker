<?php
require_once 'lib/common.php';
require_once 'lib/install.php';
session_start();
if($_POST) {
    $pdo = getPDO();

    $error = installBlog($pdo);
    if (!$error) {
        getAPI($pdo);
    }
    $_SESSION['error'] = $error;
    $_SESSION['attempted'] = true;

    redirectAndExit("install.php");
}
$attempted = false;
if(isset($_SESSION['attempted'])) {
    $error = $_SESSION['error'];
    $attempted = $_SESSION['attempted'];
    unset($_SESSION['error']);
    unset($_SESSION['attempted']);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Heidi's Virginia Legislative Website Tracker</title>
</head>
<body>
<?php if ($attempted) : ?>
<?php if($error): ?>
<p> <?php echo $error ?></p>
<?php else: ?>
<p> Install Successful</p>
<?php endif ?>
<?php else: ?>
<p> Click the install button to reset the database. Please note this may take up to ten minutes
Also, this is done in php, so the browser may time out unless the php configuration is altered
to accomodate the install.</p>
<form method = "post">
    <input
            name = "install"
            type = "submit"
           value = "Install">
</form>
<?php endif ?>

</body>
</html>

