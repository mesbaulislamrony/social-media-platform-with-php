<?php
require('connection.php');
if($_POST['submit_as'] == 'message_send')
{
    $auth_id = $_SESSION['auth']['id'];
    $message = (!empty($_POST['message'])) ? $_POST['message'] : '&#128077;';
    $id = $_GET['id'];


    $sql = "SELECT friendship_id FROM friendships WHERE auth_id = '".$auth_id."' AND friend_id = '".$_GET['id']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $sql_sender = "INSERT INTO messages (conversion_id, auth_id, message, created_at) VALUES ('".$row['friendship_id']."', '".$auth_id."', '".$message."', '".date('Y-m-d h:i:s')."')";

        $conn->query($sql_sender);

        $sender_message = [
            'id' => $_SESSION['auth']['id'],
            'name' => $_SESSION['auth']['name'],
            'message' => $message
        ];
        $sql_count_message = "SELECT * FROM messages WHERE auth_id = '".$auth_id."' AND updated_at IS NULL";
        $result_count_message = $conn->query($sql_count_message);
        $pusher->trigger('message-count-channel'.$id.'', 'message-count-event'.$id.'', $result_count_message->num_rows);
        $pusher->trigger('message-replay-channel'.$id.'', 'message-replay-event'.$id.'', $sender_message);

        echo json_encode($sender_message);
        exit();
    }
    else
    {
        echo json_encode([
            'type' => 'error',
            'message' => 'Error ! You have no longer friendships'
        ]);
        exit();
    }
}
echo json_encode([
    'type' => 'error',
    'message' => 'Error ! Message send failed'
]);
exit();
?>