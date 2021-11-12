<?php

class PostsController extends BaseController {

    protected function index () {
        $this->viewParams['posts'] = Posts::getAll();
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
    protected function detail ($params) {
        $this->viewParams['post'] = Posts::getById($params[0]);
        $this->viewParams['comments'] = Comments::getAllById($params[0]);

        if(isset($_POST['create_message'])){
            global $loggedIn_user;
            $valid = true;
            $comment = new Comments();
            var_dump($_POST['create_message']);
            $comment->replied_user_id = $loggedIn_user->id;
            $comment->created_on = date("Y/m/d");
            $comment->posts_id = $params[0];
            $comment->message = trim( $_POST['message'] );
            
            if( empty($comment->message)){
                $valid = false;
            }
            
            if($valid) {
                    $commentId = $comment->createComment($comment);
                    header("Refresh:0");
            }

            else {
                //give feedback
                echo 'FAIL';
            }
        }

        if(isset($_POST['delete_message'])){
            $comment = new Comments();
            global $loggedIn_user;

            $valid = true;
            
            $id = trim( $_POST['message_id'] );
            
            
            if( empty($id)){
                $valid = false;
            }

            if($valid) {
                    $comment->deleteById($id);
                    header("Refresh:0");
             
            }
            else {
                //give feedback
                echo 'FAIL';
            }
            
        }
        
        if(isset($_POST['update_message'])){
            
            $comment = new Comments();
            $valid = true;
            if ($_POST['message_update'] !== null) { $comment->message = trim( $_POST['message_update'] ); };
            if ($_POST['message_id'] !== null) { $comment->id  = $_POST['message_id'];};
            if( empty($comment->message)) {
                $valid = false;
            }
            if($valid) {
                    $comment->updateComment($comment);

                    header("refresh:0");
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
    protected function deletePost ($params) {
        $this->viewParams['post'] = Posts::deleteById($params[0]);
        header("Location: /home");
        $this->loadView();
    }

    
}