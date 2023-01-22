<?php
require('connection.php');
if(!empty($_GET['id']))
{
    $auth_id = $_SESSION['auth']['id'];
    $id = $_GET['id'];
    $friendships_id = chr(rand(65,90)).substr(time(), 1, -1).chr(rand(65,90));
    $sql1 = "INSERT INTO friendships (friendship_id, auth_id, friend_id, created_at) VALUES ('".$friendships_id."', '".$auth_id."', '".$id."', '".$today."')";
    $sql2 = "INSERT INTO friendships (friendship_id, auth_id, friend_id, created_at) VALUES ('".$friendships_id."', '".$id."', '".$auth_id."', '".$today."')";
    $sql3 = "DELETE FROM friend_requests WHERE request_from_id = '".$id."' AND request_to_id = '".$auth_id."'";

    if (($conn->query($sql1) === TRUE) && ($conn->query($sql2) === TRUE) && ($conn->query($sql3) === TRUE)) {
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Friend request accept successfully'
        ];
    } else {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Error ! Friend request accept failed'
        ];
    }
}
header("location:friends.php");
exit();
?>