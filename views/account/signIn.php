<?php
    $title = 'Sign in';
    $css = 'account';
    include_once BASE_DIR . '/views/_templates/_partials/header_empty.php';
?>
<div >
    <h1 class="title"><span>I</span>Social</h1>
    <form method="POST" class="signUp_form">
        <fieldset>
            <h2>Log in</h2>
            <label>
                <span>E-mail</span><br/>
                <input type="email" name="email" maxlenght="256" value="<?php echo $user->email ?? ''; ?>" required>
            </label><br/>
            <label>
                <span>Password</span><br/>
                <input type="password" name="password" required>
            </label><br/>
            <button type="submit" name="create_user">Log in</button>
            <p>Dont have an account yet? <a href="./signUp">Register here!</a></p>
            <p>Continue as visitor?*<a href="/home">Click here</a></p>
            <p class="small_font">*continuing as a visitor wont allow you to comment, like or post, only view.</p>
        </fieldset>
    </form>
</div>

<?php 
include_once BASE_DIR . '/views/_templates/_partials/footer.php';
?>
