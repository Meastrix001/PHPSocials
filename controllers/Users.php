<?php

class UsersController extends BaseController {

    protected function index () {
        $this->viewParams['users'] = Users::getAll();

        $this->loadView();
    }

    protected function detail ($params) {
        $this->viewParams['user'] = Users::getById($params[0]);
        
        $this->loadView();
    }
}