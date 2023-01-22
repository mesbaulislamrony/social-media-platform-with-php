<?php
require('connection.php');
if($_POST['submit_as'] == 'create_an_account')
{
    $name = $_POST['name'];
    $mobile_no = $_POST['mobile_no'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name, mobile_no, password, created_at) VALUES ('".$name."', '".$mobile_no."', '".md5($password)."', '".$today."')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Account created successfully'
        ];
    } else {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Error ! Account created failed'
        ];
    }
}
header("location:create-an-account.php");
exit();
?>