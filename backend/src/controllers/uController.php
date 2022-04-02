<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\models\User;


class uController extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function uindex(){
        //acl true
        $r = User::getAll();
        $this->render('User/home', ['op'=>0,'response'=>1,'message'=>'success','Users' => $r]);
    }
    public function addU($data){
        $UserName = $data['name'];
        $UserRoleID = $data['roleid'];
        $UserNickName = $data['nickname'];
        $UserPass = $data['password'];
        if(!is_null($UserName) && !is_null($UserRoleID) && !is_null($UserNickName) && !is_null($UserNickName)){
            $r = new User($UserRoleID,$UserName,$UserNickName,$UserPass);
            $r->save();
            $this->render('User/home', ['op'=>1,'response'=>1,'message'=>'add successfuly']);
        }else{
            echo "error";
            //$this->render('errors/index');
        }
    }
    public function editU($data,$id){
        $UserName    = $data['name'];
        $UserRoleID = $data['roleid'];
        $UserNickName = $data['nickname'];
        $UserPass = $data['password'];
        $UserEstReg  = $data['state'];
        if(! is_null($id) && !is_null($UserName) && !is_null($UserRoleID) && !is_null($UserNickName) && !is_null($UserPass) && !is_null($UserEstReg)){
            $r = User::getByIds($id);
            $r->setUserName($UserName);
            $r->setUserNickName($UserNickName);
            $r->setUserPass($UserPass);
            $r->setUserEstReg($UserEstReg);
            $r->update();
            $this->render('User/home', ['op'=>3,'response'=>1,'message'=>'update successfuly','user' => $r]);
        }else{
            echo "Error";
        }
    }

    public function viewU($data){
        $r = User::getById($data);
        $this->render('User/home', ['op'=>2,'response'=>1,'message'=>'success','user' => $r]);
    }
    public function deleteU($data){
        $r = User::delete($data);
        $this->render('User/home', ['op'=>4,'response'=>1,'message'=>'delete success']);
    }
}