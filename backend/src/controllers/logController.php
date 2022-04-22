<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\models\User;


class logController extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function login($data){
        $UserName = $data['name'];
        $UserPass = $data['password'];
        
        if(!is_null($UserName) && !is_null($UserPass)){
            if(User::exists($UserName)){
                $user = User::get($UserName); 
                if($user->comparePassword($UserPass)){
                    //guardarlo como toArray() el user de linea 21 guardarlo como un toArray
                    $_SESSION['user'] = serialize($user->toArray_2());
                    //direccionar correctamente generar respuestas generales
                    $this->render('/home', ['op'=>1,'response'=>1,'message'=>'login successfully','user'=>$_SESSION['user'] ]);
                }else{
                    echo "contraseña incorrecta";
                    //$this->render('/../Errors/home', ['op'=>0,'response'=>3,'message'=>'Wrong Password']);
                }
            }else{
                echo "usuario no existe";
                //$this->render('/../Errors/home', ['op'=>0,'response'=>2,'message'=>'User does not Exist']);
            }    
        }else{
            echo "error";
        }
    }
    public function logout(){
        if(isset($_SESSION['user'])){
            session_destroy();
            $this->render('/home', ['op'=>2,'response'=>1,'message'=>'Logout successfully']);
        }else{
            $this->render('/home', ['op'=>2,'response'=>2,'message'=>'Usuario no inicio sesion previamente']);
        }
    }
}