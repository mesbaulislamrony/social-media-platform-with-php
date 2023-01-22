<?php require('header.php'); ?>
<?php require('check_auth.php'); ?>
<div style="width: 520px; margin: auto;">
    <?php require('dashboard-menus.php'); ?>
    <?php
    $sql = "SELECT users.name, users.mobile_no, request_from_id, request_to_id, auth_id FROM users 
    LEFT JOIN friend_requests ON friend_requests.request_to_id = users.id AND request_from_id = '".$_SESSION['auth']['id']."'
    LEFT JOIN friendships ON friendships.auth_id = users.id
    WHERE users.id = '".$_GET['id']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <ul style="list-style: none;">
        <li style="position: relative; padding: 2px 0;">
            <h4><?php echo $row['name']; ?></h4>
            <p><?php echo $row['mobile_no']; ?></p>
            <div style="position: absolute; right: 0; top: 0; line-height: 36px;">
                <?php if(empty($row['request_from_id']) && empty($row['auth_id'])){ ?>
                <a style="margin-right: 2px;" href="friend-request-send-action.php?id=<?php echo $row['id']; ?>">Send Request</a>
                <?php } ?>

                <?php if(!empty($row['request_from_id'])){ ?>
                <?php if($row['request_from_id'] == $_SESSION['auth']['id']){ ?>
                <a style="margin-left: 2px;" href="friend-request-cancel-action.php?id=<?php echo $row['id']; ?>">Cancel Request</a>
                <?php } ?>
                <?php if($row['request_to_id'] == $_SESSION['auth']['id']){ ?>
                <a style="margin-right: 2px;" href="friend-request-accept-action.php?id=<?php echo $row['id']; ?>">Accept</a>
                <a style="margin-left: 2px;" href="friend-request-cancel-action.php?id=<?php echo $row['id']; ?>">Cancel</a>
                <?php } ?>
                <?php } ?>

                <?php if(!empty($row['auth_id'])){ ?>
                <a style="margin-right: 2px;" href="friend-unfriend-action.php?id=<?php echo $row['id']; ?>">Unfriend</a>
                <?php } ?>
            </div>
        </li>
    </ul>
	<?php } else { ?>
	<p style="color: #FF0000; margin-bottom: 10px; text-align: center;">Error ! Profile not found</p>
	<?php } ?>
</div>
<?php require('footer.php'); ?>