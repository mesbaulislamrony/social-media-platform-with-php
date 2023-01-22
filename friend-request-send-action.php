<?php
require('connection.php');
require('vendor/autoload.php');
if(!empty($_GET['id']))
{
    $auth_id = $_SESSION['auth']['id'];
    $id = $_GET['id'];

    $sql_check_friend_request = "SELECT * FROM friend_requests WHERE request_from_id = '".$id."' AND request_to_id = '".$auth_id."'";
    $result_check_friend_request = $conn->query($sql_check_friend_request);
    if ($result_check_friend_request->num_rows > 0) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Error ! Friend request already send to you.'
        ];
        header("location:friends.php");
        exit();
    }

    $sql_send_friend_request = "INSERT INTO friend_requests (request_from_id, request_to_id, created_at) VALUES ('".$auth_id."', '".$id."', '".$today."')";

    if ($conn->query($sql_send_friend_request) === TRUE) {
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Friend request send successfully'
        ];

        $sql_notification = "INSERT INTO notifications (auth_id, notification, created_at) VALUES ('".$id."', 'You\'ve got friend request from ".$_SESSION['auth']['name'].".', '".$today."')";
        $conn->query($sql_notification);

        $sql_count_friend_request = "SELECT * FROM friend_requests WHERE request_to_id = '".$id."'";
        $result_count_friend_request = $conn->query($sql_count_friend_request);
        $pusher->trigger('send-request-channel'.$id.'', 'send-request-event'.$id.'', $result_count_friend_request->num_rows);

        $sql_count_notification = "SELECT * FROM notifications WHERE auth_id = '".$id."' AND read_as = 0";
        $result_count_notification = $conn->query($sql_count_notification);
        $pusher->trigger('notification-channel'.$id.'', 'notification-event'.$id.'', $result_count_notification->num_rows);

    } else {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Error ! Friend request send failed'
        ];
    }
}
header("location:friends.php");
exit();
?>