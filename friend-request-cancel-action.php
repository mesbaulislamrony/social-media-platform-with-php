<?php
require('connection.php');
if(!empty($_GET['id']))
{
    $auth_id = $_SESSION['auth']['id'];
    $id = $_GET['id'];

    $sql = "DELETE FROM friend_requests WHERE request_from_id = '".$auth_id."' AND request_to_id = '".$id."'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Friend request cancel successfully'
        ];
    } else {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Error ! Friend request cancel failed'
        ];
    }
}
header("location:friends.php");
exit();
?>