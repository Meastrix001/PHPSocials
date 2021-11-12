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
                    header('Refresh:0');
            }
            else {
                //give feedback
                echo 'FAIL';
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
                echo("fail");
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
                echo("fail");
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
}