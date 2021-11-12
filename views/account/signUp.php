<?php
    $title = 'Sign in';
    $css = 'account';
    include_once BASE_DIR . '/views/_templates/_partials/header_empty.php';
?>
<div>
    <h1 class="title"><span>I</span>Social</h1>
    <form method="POST" enctype="multipart/form-data" class="signUp_form">
            <fieldset>
            <h2>Sign up</h2 >
                <label>
                    <span>Username</span>
                    <input type="text" name="username" maxlenght="128" value="<?php echo $user->username ?? ''; ?>" required>
                </label><br/>
                <label>
                    <span>Firstname</span>
                    <input type="text" name="firstname" maxlenght="128" value="<?php echo $user->firstname ?? ''; ?>" required>
                </label><br/>
                <label>
                    <span>Lastname</span>
                    <input type="text" name="lastname" maxlenght="128" value="<?php echo $user->lastname ?? ''; ?>" required>
                </label><br/>
                <label>
                    <span>E-mail</span>
                    <input type="email" name="email" maxlenght="256" value="<?php echo $user->email ?? ''; ?>" required>
                </label><br/>
                <label>
                    <span>Password</span>
                    <input type="password" name="password" required>
                </label><br/>
                <label>
                    <span>Re-enter Password</span>
                    <input type="password" name="password2" required>
                </label><br/>
                <label>
                    <span>Add profile picture</span>
                    <input type="file" name="file" id="file"><br><br>
                </label><br/>
                <button type="submit" name="create_user">Create account</button>
            <p>Already have an account? <a href="./signIn">Log in here!</a></p>
    
            </fieldset>
        </form>
</div>