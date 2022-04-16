<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\models\User;
use User\Backend\models\Access;


class homeController extends Controller{

    
    function __construct(private User $user)
    {
        parent::__construct();
    }
    public function homeindex(){
        $a =Access::getAll();
        $this->render('/home', ['op'=>0,'response'=>1,'message'=>'Hello this is your own user','user'=>$this->user,'permises'=>$a]);

    }
}