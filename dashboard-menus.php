<?php
$sql_friend_requests = "SELECT users.id, users.name, users.mobile_no FROM friend_requests
JOIN users ON users.id = friend_requests.request_from_id WHERE request_to_id = '".$_SESSION['auth']['id']."' ORDER BY friend_requests.id DESC";
$result_friend_requests = $conn->query($sql_friend_requests);

$sql_update_unread_notificatin = "UPDATE notifications SET read_as = 1 WHERE auth_id = ".$_SESSION['auth']['id']." AND read_as = 0";
$conn->query($sql_update_unread_notificatin);

$sql_count_notification = "SELECT * FROM notifications WHERE auth_id = '".$_SESSION['auth']['id']."' AND read_as = 0";
$result_count_notification = $conn->query($sql_count_notification);

$sql_count_message = "SELECT * FROM messages WHERE auth_id = '".$_SESSION['auth']['id']."' AND updated_at IS NULL";
$result_count_message = $conn->query($sql_count_message);
?>
<ul style="list-style: none; overflow: hidden; text-align: center; margin: 0 auto 10px;">
    <li style="float: left; width: 80px; text-align: left;"><a href="dashboard.php">News Feed</a></li>
    <li style="float: left; width: 80px;"><a href="friends.php">Friends <span id="countFriendRequest"><?php echo ($result_friend_requests->num_rows > 0) ? '('.$result_friend_requests->num_rows.')': ''; ?></span></a></li>
    <li style="float: left; width: 120px;"><a href="notifications.php">Notifications <span id="countNotification"><?php echo ($result_count_notification->num_rows > 0) ? '('.$result_count_notification->num_rows.')': ''; ?></span></a></li>
    <li style="float: left; width: 100px;"><a href="messages.php">Messages <span id="countMessage"><?php echo ($result_count_message->num_rows > 0) ? '('.$result_count_message->num_rows.')': ''; ?></span></a></li>
    <li style="float: right; width: 100px; text-align: right;"><a href="profile.php"><?php echo $_SESSION['auth']['name']; ?></a></li>
</ul>