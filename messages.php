<?php require('header.php'); ?>
<?php require('check_auth.php'); ?>
<div style="width: 520px; height: 100vh; margin: auto; position: relative;">
    <?php require('dashboard-menus.php'); ?>
    <?php
    $sql = "SELECT users.id, users.name, users.mobile_no FROM friendships
    JOIN users ON users.id = friendships.friend_id WHERE auth_id = '".$_SESSION['auth']['id']."' ORDER BY friendships.id DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    ?>
    <p><strong>Your Friends (<?php echo $result->num_rows; ?>)</strong></p>
    <ul style="list-style: none; margin-bottom: 10px">
        <?php  while ($row = $result->fetch_assoc()) { ?>
        <li style="position: relative; padding: 2px 0;">
            <p><a href="friend-profile.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></p>
            <p><small><?php echo $row['mobile_no']; ?></small></p>
            <div style="position: absolute; right: 0; top: 0; line-height: 36px;">
                <a style="margin-right: 2px;" href="messenger.php?id=<?php echo $row['id']; ?>">Send Message</a>
            </div>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>
</div>
<?php require('footer.php'); ?>