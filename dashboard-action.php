<?php
require('connection.php');
if($_POST['submit_as'] == 'post_article')
{
    $auth_id = $_SESSION['auth']['id'];
    $article = $_POST['article'];
    
    $sql = "INSERT INTO news_feeds (posted_by, article, created_at) VALUES ('".$auth_id."', '".$article."', '".$today."')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Your article has been post successfully'
        ];
    } else {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Error ! Your article has been post failed'
        ];
    }
}
header("location:dashboard.php");
exit();
?>