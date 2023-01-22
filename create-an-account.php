<?php require('header.php'); ?>
<div style="display: table; height: 100%; width: 320px; margin: auto;">
    <div style="display: table-cell; vertical-align: middle;">
        <h4>Create an account</h4>
        <form id="createAccount" action="create-an-account-action.php" method="POST">
            <div>
                <p><label for="name">Name :</label></p>
                <input style="width: 100%;" type="text" id="name" name="name" placeholder="Name" required>
            </div>
            <div>
                <p><label for="mobile_no">Mobile No :</label></p>
                <input style="width: 100%;" type="text" id="mobile_no" name="mobile_no" placeholder="Mobile No" required>
            </div>
            <div>
                <p><label for="password">Password :</label></p>
                <input style="width: 100%;" type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" id="submit" name="submit_as" value="create_an_account" style="margin: 4px 0; padding: 2px;">Submit</button>
            <a href="index.php">Login</a>
        </form>
    </div>
</div>
<?php require('footer.php'); ?>