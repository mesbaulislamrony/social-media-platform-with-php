<?php require('header.php'); ?>
<?php require('check_auth.php'); ?>
<div style="width: 520px; margin: auto;">

    <?php require('dashboard-menus.php'); ?>
    
    <?php if ($result_friend_requests->num_rows > 0) { ?>
    <p><strong>Friend Requests (<?php echo $result_friend_requests->num_rows; ?>)</strong></p>
    <ul style="list-style: none; margin-bottom: 10px">
        <?php  while ($row = $result_friend_requests->fetch_assoc()) { ?>
        <li style="position: relative; padding: 2px 0;">
            <p><a href="friend-profile.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></p>
            <p><small><?php echo $row['mobile_no']; ?></small></p>
            <div style="position: absolute; right: 0; top: 0; line-height: 36px;">
                <a style="margin-right: 2px;" href="friend-request-accept-action.php?id=<?php echo $row['id']; ?>">Accept</a>
                <a style="margin-left: 2px;" href="friend-request-deny-action.php?id=<?php echo $row['id']; ?>">Cancel</a>
            </div>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>


    <?php
    $sql = "SELECT users.id, users.name, users.mobile_no FROM friendships
    JOIN users ON users.id = friendships.friend_id WHERE auth_id = '".$_SESSION['auth']['id']."' ORDER BY friendships.id DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    ?>
    <p><strong>Your Friends (<?php echo $result->num_rows; ?>)</strong></p>
    <ul style="list-style: none; margin-bottom: 10px">
        <?php  while ($row = $result->fetch_assoc()) { ?>
        <li style="position: relative; padding: 2px 0;">
            <p><a href="friend-profile.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></p>
            <p><small><?php echo $row['mobile_no']; ?></small></p>
            <div style="position: absolute; right: 0; top: 0; line-height: 36px;">
                <a style="margin-right: 2px;" href="friend-unfriend-action.php?id=<?php echo $row['id']; ?>">Unfriend</a>
            </div>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>

    <p><strong>People You May Know</strong></p>
    <?php
    $sql = "SELECT users.id, users.name, users.mobile_no, request_to_id FROM users  LEFT JOIN friend_requests ON friend_requests.request_to_id = users.id AND friend_requests.request_from_id = '".$_SESSION['auth']['id']."' LEFT JOIN friendships ON friendships.auth_id = users.id WHERE users.id != '".$_SESSION['auth']['id']."' AND auth_id IS NULL ORDER BY users.id ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    ?>
    <ul style="list-style: none;">
        <?php  while ($row = $result->fetch_assoc()) { ?>
    	<li style="position: relative; padding: 2px 0;">
    		<p><a href="friend-profile.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></p>
    		<p><small><?php echo $row['mobile_no']; ?></small></p>
    		<div style="position: absolute; right: 0; top: 0; line-height: 36px;">
                <?php if(empty($row['request_to_id'])){ ?>
                <a style="margin-right: 2px;" href="friend-request-send-action.php?id=<?php echo $row['id']; ?>">Send Request</a>
                <?php } ?>
                <?php if(!empty($row['request_to_id'])){ ?>
	    		<a style="margin-left: 2px;" href="friend-request-cancel-action.php?id=<?php echo $row['id']; ?>">Cancel Request</a>
                <?php } ?>
    		</div>
    	</li>
        <?php } ?>
    </ul>
    <?php } ?>
</div>
<?php require('footer.php'); ?>