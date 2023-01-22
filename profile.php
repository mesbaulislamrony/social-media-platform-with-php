<?php require('header.php'); ?>
<?php require('check_auth.php'); ?>
<div style="width: 520px; margin: auto;">
    <?php require('dashboard-menus.php'); ?>
    <h3><?php echo $_SESSION['auth']['name']; ?></h3>
    <p><?php echo $_SESSION['auth']['mobile_no']; ?></p>
    <a href="logout-action.php">Logout</a>
</div>
<?php require('footer.php'); ?>