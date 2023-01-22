<?php require('header.php'); ?>
<div style="display: table; height: 100%; width: 320px; margin: auto;">
    <div style="display: table-cell; vertical-align: middle;">
        <h4>Login</h4>
        <form  action="login-action.php" id="login" method="POST">
            <div>
                <p>
                    <label for="mobile_no">Mobile No :</label>
                </p>
                <input type="text" id="mobile_no" name="mobile_no" placeholder="Mobile No" required>
            </div>
            <div>
                <p>
                    <label for="password">Password :</label>
                </p>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" id="submit" name="submit_as" value="login" style="margin: 4px 0; padding: 2px;">Login</button>
            <a href="create-an-account.php">Create an Account</a>
        </form>
    </div>
</div>
<?php require('footer.php'); ?>