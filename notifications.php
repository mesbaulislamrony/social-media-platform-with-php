<?php require('header.php'); ?>
<?php require('check_auth.php'); ?>
<div style="width: 520px; margin: auto;">
    <?php require('dashboard-menus.php'); ?>
    <?php
	$sql_notification = "SELECT * FROM notifications WHERE auth_id = ".$_SESSION['auth']['id']."";
	$result_notification = $conn->query($sql_notification);
    ?>
    <p><strong>Notifications</strong></p>
    <?php
    if ($result_notification->num_rows > 0) {
    while ($row = $result_notification->fetch_assoc()) {
    ?>
	<div style="position: relative; margin: 5px 0; display: block; padding-right: 100px;">
		<p><?php echo $row['notification']; ?></p>
		<div style="position: absolute; right: 0; top: 0;"><?php echo $row['created_at'] ?></div>
	</div>
    <?php
	}
	}
	?>
</div>
<?php require('footer.php'); ?>