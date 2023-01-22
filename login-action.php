<?php
require('connection.php');
if($_POST['submit_as'] == 'login')
{
    $mobile_no = $_POST['mobile_no'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE mobile_no = '".$mobile_no."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (md5($password) == $row['password']) {
            $_SESSION['auth'] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'mobile_no' => $row['mobile_no']
            ];
            header("location:dashboard.php");
            exit();
        } else {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Error ! You\'ve entered the wrong password'
            ];
        }
    } else {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Error ! login failed'
        ];
    }
}
header("location:index.php");
exit();
?>