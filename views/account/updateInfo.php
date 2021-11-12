<?php
    $title = 'Users';
    $css = 'account';
    global $loggedIn_user;
    include_once BASE_DIR . '/views/_templates/_partials/header.php';
?>
    <form method="POST">
        <fieldset>
            <legend>Profile</legend>
            <label>
                <span>Username</span>
                <input type="text" name="username" maxlenght="128" value="<?php echo $loggedIn_user->username ?? 'Username'?>" required>
            </label><br/>
            <label>
                <span>Firstname</span>
                <input type="text" name="firstname" maxlenght="128" value="<?php echo $loggedIn_user->firstname ?? 'Firstname'; ?>" required>
            </label><br/>
            <label>
                <span>Lastname</span>
                <input type="text" name="lastname" maxlenght="128" value="<?php echo $loggedIn_user->lastname ?? 'Lastname'; ?>" required>
            </label><br/>
            <label>
                <span>E-mail</span>
                <input type="email" name="email" maxlenght="256" value="<?php echo $loggedIn_user->email ?? ''; ?>" required>
            </label><br/>
        </fieldset>
        <button type="submit" name="update_user">update</button>
    </form>

<?php 
include_once BASE_DIR . '/views/_templates/_partials/footer.php';
?>
