<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;

class Home extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->render('home', ['user' => "Hola"]);
    }

    /*public function store(){

        $title = $this->post('title');
        $image = $this->file('image');

        if(!is_null($title) && !is_null($image)){
            $url = UtilImages::storeImage($image);
            if(!is_null($url)){
                error_log($title);
                error_log($url);
                $post = new PostImage($title, $url);
                $this->user->publish($post);
            }
        }
    }*/

    

}