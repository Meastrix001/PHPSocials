<?php

class AccountController extends BaseController {
    
    protected function index () {
        $this->viewParams['users'] = Users::getAll();
        $this->loadView();
    }

    protected function deleteUser ($params) {
        $this->viewParams['users'] = Users::deleteById($params[0]);
        $this->loadView();
    } 

    protected function updateInfo ($params) {
        $user_id = $params[0];
        global $loggedIn_user;

        if( isset($_POST['update_user'])) {
            if($user_id) {
                $user = new Users();
                } else {
                    Echo "something went wrong";
                }
        $valid = true;
        if ($_POST['username'] !== null) { $user->username = trim( $_POST['username'] ); };
        if ($_POST['firstname'] !== null) { $user->firstname = trim( $_POST['firstname'] );};
        if ($_POST['lastname'] !== null) { $user->lastname = trim( $_POST['lastname'] );};
        if ($_POST['email'] !== null) { $user->email = trim( $_POST['email'] );};
        $user->id = $loggedIn_user->id;
        if( empty($user->firstname) || empty($user->lastname) || empty($user->email)) {
            $valid = false;
        }
        
        if ($user->email !== $loggedIn_user->email && $user->emailExists( $user->email ) ) {
            echo "De email $user->email is al in gebruik." ;
            $valid = false;
        }
        
        if($valid) {
            if($user_id) {
                $user->updateUser($user);
                header("Location: /account/detail/$user->id");
            }
        }
        else {
            //give feedback
            echo 'updating failed';
        }
        }

        $this->loadView();
    }

    protected function logout () {
        if (isset($_COOKIE['email'])) {
            $this->loadView();
            return true;
        } else {
            $this->loadView("signIn");
        }
    }

    protected function detail ($params) {
        $this->viewParams['user'] = Users::getById($params[0]);
        $this->viewParams['posts'] = Posts::getAllFilteredPosts($params[0]);
        $this->viewParams['comments'] = Comments::getAllById($params[0]);
        $this->viewParams['followers'] = Friends::getAllFollowers($params[0]); //people following me
        $this->viewParams['following'] = Friends::getAllFollowing($params[0]); //people i am following
        $this->viewParams['comments'] = Comments::getAllById($params[0]);

        if(isset($_POST['log_out'])){
            global $loggedIn_user;
            session_destroy();
            deleteUserCookie();
            header("Location: /account/signIn");
        }

        if(isset($_POST['follow_user'])){
            global $loggedIn_user;
            $valid = true;
            $Follow = new Follower();
            if ($_POST['user_id'] !== null) { $Follow->follower_id  = $_POST['user_id'];};
            $Follow->users_id = $loggedIn_user->id;
            $Follow->date_following = date("Y/m/d");

            
            if( empty($Follow->users_id)){
                $valid = false;
                echo("fail");
            }

            if($valid) {
                    $likeId = $Follow->createFollows($Follow);
                    header("Refresh:0");
            }
            else {
                echo("fail");
            }
            
        }

        if(isset($_POST['unFollow_user'])){
            global $loggedIn_user;
            $valid = true;
            $Follow = new Follower();
            if ($_POST['user_id'] !== null) { $Follow->follower_id  = $_POST['user_id'];};

            if(empty($Follow)){
                $valid = false;
                echo("fail");
            }

            if($valid) {
                $FollowId = $Follow->deleteById($Follow->follower_id);
                header("Refresh:0");
            }
            else {
                echo("fail");
            }
        }

        if(isset($_POST['Liked_message'])){
            global $loggedIn_user;
            $valid = true;
            $like = new Likes();
            if ($loggedIn_user !== null) {$like->users_id = $loggedIn_user->id;};
            if ($_POST['post_id'] !== null) { $like->posts_id  = $_POST['post_id'];};
            $like->created_on = date("Y/m/d");

            
            if( empty($like->users_id) ?? empty($like->posts_id)){
                $valid = false;
            }

            if($valid) {
                    $likeId = $like->createLike($like);
                    header("Refresh:0");
            }
            else {
                echo("fail");
            }
            
        }

        if(isset($_POST['unlike_message'])){
            global $loggedIn_user;
            $valid = true;
            $like = new Likes();
            if ($_POST['post_id'] !== null) { $postId  = $_POST['post_id'];};

            if(empty($postId)){
                $valid = false;
            }

            if($valid) {
                $likeId = $like->deleteById($postId);
                header("Refresh:0");
            }
            else {
                echo("fail");
            }
        }


        $this->loadView();
    }

    protected function signUp () {
        
            $user = new Users();

            if( isset($_POST['create_user']) ) {
            $valid = true;
            $user->username = trim( $_POST['username'] );
            $user->firstname = trim( $_POST['firstname'] );
            $user->lastname = trim( $_POST['lastname'] );
            $user->email = trim( $_POST['email'] );
            $user->password1 = ( $_POST['password']);
            $user->password2 = ( $_POST['password']);
            $user->password = password_hash( $_POST['password'], PASSWORD_DEFAULT );
            

            $uploads_dir = BASE_DIR . '/images/users/';
            $name = $_FILES['file']['name'];
            if(isset($name) and !empty($name)){     
                if(is_uploaded_file($_FILES['file']['tmp_name'])); {
                    move_uploaded_file($_FILES['file']['tmp_name'], $uploads_dir.$name);
                    $user->image = $name;
                }
            } else {
                echo 'You should select a file to upload !!';
            }

            if( empty($user->firstname) || empty($user->lastname) || empty($user->email) || empty($user->password)) {
                $valid = false;
            }
        var_dump($user);

            if ( !$user && $user->emailExists( $user->email ) ) {
                echo "De email $user->email is al in gebruik." ;
                $valid = false;
            }

            if($valid) {
                if($user) {
                    $user->createUser($user);
                    setUserCookie($user->email);
                    header("Location: /home");
                }
            }
            else {
                //give feedback
                echo 'FAIL';
            }
            }
            $this->loadView();
    }

    protected function signIn () {
            $user = new Users();

            if( isset($_POST['create_user']) ) {
            $valid = true;
            $user->email = trim( $_POST['email'] );  
            $user->password = ( $_POST['password']);
            
            if( empty($user->email) || empty($user->password)) {
                $valid = false;
            }

            if ( !$user->emailExists( $user->email ) ) {
                echo "het email-adress `$user->email` bestaat niet." ;
                $valid = false;
            }

            if($valid) {
                    $loggedIn_user = getUserByCred($user->email, $user->password);
                    setUserCookie($loggedIn_user->email);
                    header("Location: /home");

            }
            else {
                //give feedback
                echo 'FAIL';
            }
            }
            $this->loadView();
        }

    }
    