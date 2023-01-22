<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>RAW PHP PUSHER</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <style type="text/css">
    *{
        margin: 0;
        padding: 0;
    }
    html,
    body{
        width: 100%;
        height: 100%;
        display: block;
    }
    #alert{
        position: absolute;
        left: 0;
        top: 22px;
        margin: auto;
        right: 0;
        width: 320px;
        padding: 5px;
        border: 1px solid #ddd;
        background-color: #ddd;
        border-radius: 4px;
        z-index: 999;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://js.pusher.com/4.0/pusher.min.js"></script>
    <?php require('connection.php'); ?>
    <script>
    axios.defaults.baseURL = 'http://localhost:8012/temporary-test-development/pusher/';
    axios.defaults.headers['Content-Type'] = 'application/json';

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('fcafd01d6d4172b5c5bb', {
        cluster: 'ap2',
        encrypted: true
    });

    var sendRequestChannel = pusher.subscribe('send-request-channel<?php echo $_SESSION['auth']['id'] ?>');
    sendRequestChannel.bind('send-request-event<?php echo $_SESSION['auth']['id'] ?>', function(data) {
        $("#countFriendRequest").html('('+data+')')
    });
    var notificationChannel = pusher.subscribe('notification-channel<?php echo $_SESSION['auth']['id'] ?>');
    notificationChannel.bind('notification-event<?php echo $_SESSION['auth']['id'] ?>', function(data) {
        $("#countNotification").html('('+data+')')
    });
    var messageChannel = pusher.subscribe('message-count-channel<?php echo $_SESSION['auth']['id'] ?>');
    messageChannel.bind('message-count-event<?php echo $_SESSION['auth']['id'] ?>', function(data) {
        $("#countMessage").html('('+data+')')
    });
    var messageReplayChannel = pusher.subscribe('message-replay-channel<?php echo $_SESSION['auth']['id'] ?>');
    messageReplayChannel.bind('message-replay-event<?php echo $_SESSION['auth']['id'] ?>', function(data) {
        var li = '<li style="padding: 5px;">';
    		li += '<p><a href="friend-profile.php?id='+data.id+'">'+data.name+'</a></p>';
    		li += '<p>'+data.message+'</p>';
    	li += '</li>'
        $("#messages").append(li);
        $('#messages').scrollTop($('#messages')[0].scrollHeight);
    });
    </script>
</head>

<body>