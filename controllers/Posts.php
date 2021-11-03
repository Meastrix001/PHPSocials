<?php

class PostsController extends BaseController {

    protected function index () {
        $this->viewParams['posts'] = Posts::getAll();

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
                    echo "Succesvol $commentId gepost";
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
                    echo "deleted message ";
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
                    echo "updated comment $comment->id";
                    header("refresh:0");
                }
            }
        $this->loadView();
}
    protected function deletePost ($params) {
        $this->viewParams['post'] = Posts::deleteById($params[0]);
        
        $this->loadView();
    }

    
}