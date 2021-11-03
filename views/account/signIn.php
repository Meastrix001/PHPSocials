<?php
    $title = 'Sign in';
    $css = 'account';
    include_once BASE_DIR . '/views/_templates/_partials/header.php';
?>

<form method="POST">
        <fieldset>
            <legend>Profile</legend>
                <span>E-mail</span>
                <input type="email" name="email" maxlenght="256" value="<?php echo $user->email ?? ''; ?>" required>
            </label><br/>
            <label>
                <span>Password</span>
                <input type="password" name="password" required>
            </label><br/>
        </fieldset>
        <button type="submit" name="create_user">Voeg toe</button>
    </form>

    <?php 
include_once BASE_DIR . '/views/_templates/_partials/footer.php';
?>
