<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "socailbook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$today = date('Y-m-d');

require('vendor/autoload.php');
$options = array(
    'cluster' => 'ap2',
    'encrypted' => true
);
$pusher = new Pusher\Pusher(
    'fcafd01d6d4172b5c5bb',
    '7751f67ec1bfa4e31053',
    '928223',
    $options
);

/**
 * Function : Expaired Date Checker.
 *
 * Calculate between two date.
 * Using PHP, Object, Date Functions
 * This calculator for calulate expaired date duration on current date.
*/

function is_expaired( $today, $expaired_date ){
    
    $r = $today->diff( $expaired_date );
    $obj = new stdClass();
    $obj->is_expaired = $r->invert;
    $obj->duration = ($r->days != 0) ? (($r->y > 0) ? $r->y . ' years ' : '').''.(($r->m > 0) ? $r->m . ' months ' : '').''.(($r->d > 0) ? $r->d . ' days' : '').''.(($r->invert == 1) ? ' Expaired' : ' Remaining') : 'Today';
    return $obj;
    
}

?>