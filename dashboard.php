<?php require('header.php'); ?>
<?php require('check_auth.php'); ?>
<div style="width: 520px; margin: auto;">
    <?php require('dashboard-menus.php'); ?>
    <form action="dashboard-action.php" method="POST">
        <div style="overflow: hidden;">
            <textarea name="article" placeholder="Write your post here" rows="5" style="width: calc(100% - 10px); display: block; padding: 4px;"></textarea>
            <button type="submit" id="submit" name="submit_as" value="post_article" style="margin: 4px 0; padding: 2px; float: right;">Post</button>
        </div>
    </form>
    <?php
    $sql = "SELECT users.id, users.name, users.mobile_no, news_feeds.article FROM news_feeds JOIN users ON users.id = news_feeds.posted_by ORDER BY news_feeds.id DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    ?>
    <ul style="list-style: none;">
        <?php  while ($row = $result->fetch_assoc()) { ?>
    	<li style="margin-bottom: 10px">
            <?php if($_SESSION['auth']['id'] == $row['id']){ ?>
            <p><a href="profile.php"><?php echo $row['name']; ?></a></p>
            <?php } else { ?>
            <p><a href="friend-profile.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></p>
            <?php } ?>
    		<p><?php echo $row['article']; ?></p>
    	</li>
        <?php } ?>
    </ul>
    <?php } ?>
</div>
<?php require('footer.php'); ?>