<?php

class FriendsController extends BaseController {

    protected function index () {
        global $loggedIn_user;
        $this->viewParams['friends'] = Friends::getAllfollowing($loggedIn_user->id); //people i am following

        $this->loadView();
    }

}