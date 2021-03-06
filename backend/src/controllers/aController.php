<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\models\Access;


class aController extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function aindex(){
        //acl true
        $r = Access::getAll();
        $this->render('Access/home', ['op'=>0,'response'=>1,'message'=>'success','access' => $r]);
    }
    public function addA($data){
        $AccPer = $data['permission'];
        $AccRoleID = $data['roleid'];
        $AccResID = $data['resid'];
        if(!is_null($AccPer) &&!is_null($AccRoleID) &&!is_null($AccResID)){
            $r = new Access($AccRoleID,$AccResID,$AccPer);
            $r->save();
            $this->render('Access/home', ['op'=>1,'response'=>1,'message'=>'add successfuly']);
        }else{
            echo "error";
            //$this->render('errors/index');
        }
    }
    public function editA($data,$id){
        $AccPer = $data['permise'];
        $AccRoleID = $data['roleid'];
        $AccResID = $data['resid'];
        $AccEstReg  = $data['state'];
        
        if(!is_null($id) && !is_null($AccPer) &&!is_null($AccRoleID) &&!is_null($AccResID) && !is_null($AccEstReg)){
            $r = Access::getByIds($id);
            $r->setAccPer($AccPer);
            $r->setAccRoleID($AccRoleID);
            $r->setAccResID($AccResID);
            $r->setAccEstReg($AccEstReg);
            $r->update();
            $this->render('Access/home', ['op'=>3,'response'=>1,'message'=>'update successfuly','access' => $r->toArray()]);
        }else{
            echo "Error";
        }
    }

    public function viewA($data){
        $r = Access::getById($data);

        $this->render('Access/home', ['op'=>2,'response'=>1,'message'=>'success','access' => $r]);
    }
    public function deleteA($data){
        $r = Access::delete($data);
        $this->render('Access/home', ['op'=>4,'response'=>1,'message'=>'delete success']);
    }
}