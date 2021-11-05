<?php

class AccountController extends BaseController {
    
    protected function index ($params) {
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
        echo "ID NUMBER" . $loggedIn_user->id;
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
                echo "Succesvol $user_id geupdated";
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

        echo "detail";
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
                    print_r($user);
                    echo "Account created";
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
    