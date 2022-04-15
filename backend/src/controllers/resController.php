<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\models\Resource;


class resController extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function resindex(){
        //acl true
        $r = Resource::getAll();
        $this->render('Resource/home', ['op'=>0,'response'=>1,'message'=>'success','resources' => $r]);
    }
    public function addRes($data){
        $ResName = $data['name'];
        if(!is_null($ResName)){
            $r = new Resource($ResName);
            $r->save();
            $this->render('Resource/home', ['op'=>1,'response'=>1,'message'=>'add successfuly']);
        }else{
            echo "error";
            //$this->render('errors/index');
        }
    }
    public function editRes($data,$id){
        $ResName    = $data['name'];
        $ResEstReg  = $data['state'];
        if(! is_null($id) && !is_null($ResName) && !is_null($ResEstReg)){
            $r = Resource::getByIds($id);
            $r->setResName($ResName);
            $r->setResEstReg($ResEstReg);
            $r->update();
            $this->render('Resource/home', ['op'=>3,'response'=>1,'message'=>'update successfuly','resource' => $r->toArray()]);
        }else{
            echo "Error";
        }
    }

    public function viewRes($data){
        $r = Resource::getById($data);
        $this->render('Resource/home', ['op'=>2,'response'=>1,'message'=>'success','resource' => $r]);
    }
    public function deleteRes($data){
        $r = Resource::delete($data);
        $this->render('Resource/home', ['op'=>4,'response'=>1,'message'=>'delete success']);
    }
}