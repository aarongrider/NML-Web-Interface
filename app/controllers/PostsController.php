<?php

namespace app\controllers;

class PostsController extends \lithium\action\Controller {

    public function index()
    {
        return array('foo' => 'bar', 'title' => 'Posts');
    }

}

?>