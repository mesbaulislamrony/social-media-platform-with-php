<?php
require('connection.php');
if(!empty($_GET['id']))
{
    $auth_id = $_SESSION['auth']['id'];
    $id = $_GET['id'];

    $sql1 = "DELETE FROM friendships WHERE auth_id = '".$auth_id."' AND friend_id = '".$id."'";
    $sql2 = "DELETE FROM friendships WHERE auth_id = '".$id."' AND friend_id = '".$auth_id."'";

    if (($conn->query($sql1) === TRUE) && ($conn->query($sql2) === TRUE)) {
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Unfriend successfully'
        ];
    } else {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Error ! Unfriend failed'
        ];
    }
}
header("location:friends.php");
exit();
?>