<?php

class HomeController extends BaseController {

    protected function index () {
        $this->viewParams['posts'] = Posts::getAll();
        
        if(isset($_POST['create_post'])  ){
            global $loggedIn_user;
            $valid = true;
            $post = new Posts();
            $post->description = trim( $_POST['description'] );
            $post->created_on = date("Y/m/d");
            $post->users_id = $loggedIn_user->id;

            //post
            $uploads_dir = BASE_DIR . '/images/posts/';
            $name = $_FILES['file']['name'];
            if(isset($name) and !empty($name)){     
                if(is_uploaded_file($_FILES['file']['tmp_name'])); {
                    move_uploaded_file($_FILES['file']['tmp_name'], $uploads_dir.$name);
                    $post->media = $name;
                }
            } else {
                echo 'You should select a file to upload !!';
            }

            if( empty($post->description) || empty($post->media)) {
                $valid = false;
            }

            if($valid) {
                    $post_id = $post->createPost($post);
                    echo "Succesvol $post_id aangemaakt";
                    header('Refresh:0');
            }
            else {
                //give feedback
                echo 'FAIL';
            }
            
        }
        $this->loadView();
    }
}