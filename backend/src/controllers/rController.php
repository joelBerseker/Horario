<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\models\Role;


class rController extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function rindex(){
        //acl true
        $r = Role::getAll();
        $this->render('Role/home', ['op'=>0,'response'=>1,'message'=>'success','roles' => $r]);
    }
    public function addR($data){
        $RoleName = $data['name'];
        if(!is_null($RoleName)){
            $r = new Role($RoleName);
            $r->save();
            $this->render('Role/home', ['op'=>1,'response'=>1,'message'=>'add successfuly']);
        }else{
            echo "error";
            //$this->render('errors/index');
        }
    }
    public function editR($data,$id){
        $RoleName    = $data['name'];
        $RoleEstReg  = $data['state'];
        if(! is_null($id) && !is_null($RoleName) && !is_null($RoleEstReg)){
            $r = Role::getByIds($id);
            $r->setRoleName($RoleName);
            $r->setRoleEstReg($RoleEstReg);
            $r->update();
            $this->render('Role/home', ['op'=>3,'response'=>1,'message'=>'update successfuly','role' => $r->toArray()]);
        }else{
            echo "Error";
        }
    }

    public function viewR($data){
        $r = Role::getById($data);
        $this->render('Role/home', ['op'=>2,'response'=>1,'message'=>'success','role' => $r]);
    }
    public function deleteR($data){
        $r = Role::delete($data);
        $this->render('Role/home', ['op'=>4,'response'=>1,'message'=>'delete success']);
    }
}