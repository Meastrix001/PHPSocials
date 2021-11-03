<?php

class HomeController extends BaseController {

    protected function index () {
        $this->viewParams['posts'] = Posts::getAll();
        

        $this->loadView();
    }
}