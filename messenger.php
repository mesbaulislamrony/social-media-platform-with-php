<?php require('header.php'); ?>
<?php require('check_auth.php'); ?>
<div style="width: 520px; height: 100vh; margin: auto; position: relative;">
    <?php require('dashboard-menus.php'); ?>
    <?php

    $sql_update_unread_message = "UPDATE messages SET updated_at = '".date('Y-m-d h:i:s')."' WHERE auth_id = ".$_GET['id']." AND updated_at IS NULL";
    $conn->query($sql_update_unread_message);

    $sql_messages = "SELECT message, messages.auth_id, friendships.friend_id, users.name FROM friendships LEFT JOIN messages ON messages.conversion_id = friendships.friendship_id JOIN users ON users.id = messages.auth_id WHERE friendships.auth_id = ".$_SESSION['auth']['id']." AND friendships.friend_id = ".$_GET['id']."";
    $result_messages = $conn->query($sql_messages);
    if ($result_messages->num_rows > 0) {
    ?>
    <ul id="messages" style="list-style: none; height: calc(100vh - 100px); overflow-y: scroll; padding-bottom: 15px;">
        <?php while ($row = $result_messages->fetch_assoc()) { ?>
    	<li style="<?php echo ($row['auth_id'] == $_SESSION['auth']['id']) ? 'text-align: right;' : ''; ?>padding: 5px;">
    		<p><a href="<?php echo ($row['auth_id'] == $_SESSION['auth']['id']) ? 'profile.php' : 'friend-profile.php?id=' . $row['friend_id']; ?>"><?php echo $row['name']; ?></a></p>
    		<p><?php echo $row['message']; ?></p>
    	</li>
        <?php } ?>
    </ul>
    <?php } ?>
    <form action="javaScript:;" id="messengerForm" method="POST" style="position: absolute; bottom: 0; left: 0; width: 100%;">
        <div style="overflow: hidden;">
            <textarea name="message" id="message" placeholder="Write your message here" rows="3" style="width: calc(100% - 50px); display: block; padding: 4px;"></textarea>
            <button type="submit" id="submit" name="submit_as" value="message_send" style="padding: 2px; position: absolute; right: 0; margin: 0; bottom: 0; height: 100%">Send</button>
        </div>
    </form>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("#messengerForm").on("submit", function(event){
        event.preventDefault();
        var messengerFormData = $("#messengerForm").serializeArray();
        messengerFormData.push({name: 'submit_as', value: 'message_send'});

        $.post('messenger-action.php?id=<?php echo $_GET['id']; ?>', messengerFormData, function( data ) {
        var li = '<li style="text-align: right; padding: 5px;">';
    		li += '<p><a href="profile.php">'+data.name+'</a></p>';
    		li += '<p>'+data.message+'</p>';
    	li += '</li>'
        $("#messages").append(li);
        $('#messages').scrollTop($('#messages')[0].scrollHeight);
        $("#message").val('');
        }, "json");
    });
});
</script>
<?php require('footer.php'); ?>