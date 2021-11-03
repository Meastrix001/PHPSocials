<form method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Profile</legend>
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
        </fieldset>
        <button type="submit" name="create_user">Voeg toe</button>
    </form>