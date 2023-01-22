<?php
session_start();
if (!empty($_SESSION['auth'])) {
    session_destroy();
    header("location:index.php");
    exit();
}
header("location:index.php");
exit();
?>