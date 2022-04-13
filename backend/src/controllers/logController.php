<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\models\User;


class logController extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function login(){
        $UserName = $this->post('UserName');
        $UserPass = $this->post('UserPass');  
        
        if(!is_null($UserName) && !is_null($UserPass)){
            if(User::exists($UserName)){
                $user = User::get($UserName); 
                if($user->comparePassword($UserPass)){
                    $_SESSION['user'] = serialize($user);
                    //direccionar correctamente generar respuestas generales
                    $this->render('/home', ['op'=>0,'response'=>1,'message'=>'login successfully']);
                }else{
                    $this->render('//home', ['op'=>0,'response'=>3,'message'=>'Wrong Password']);
                }
            }else{
                $this->render('/../TypeProduct/home', ['op'=>0,'response'=>2,'message'=>'User does not Exist']);
            }    
        }else{
            echo "error";
        }
    }
    public function logout(){
        session_destroy();
        $this->render('/TypeProduct/home', ['op'=>0,'response'=>1,'message'=>'logout successfully']);
    }
}