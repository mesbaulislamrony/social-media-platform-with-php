<?php
if (empty($_SESSION['auth'])) {
    header("location:index.php");
    exit();
}
?>