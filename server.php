<?php
require('vendor/autoload.php');

// require_once __DIR__ . '/vendor/autoload.php';
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

if(isset($_POST['name']))
{
	$name = $_POST['name'];
}
else
{
	$name = "Client";
}

$data['message'] = 'Hello '.$name;
$pusher->trigger('my-channel', 'my-event', $data);