<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\models\Tabl;


class tController extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function tindex(){
        //acl true
        $r = Tabl::getAll();
        $this->render('Tabl/home', ['op'=>0,'response'=>1,'message'=>'success','Tabl' => $r]);
    }
    public function addT($data){
        $TabEst = $data['reserved'];
        if(!is_null($TabEst)){
            $r = new Tabl($TabEst);
            $r->save();
            $this->render('Tabl/home', ['op'=>1,'response'=>1,'message'=>'add successfuly']);
        }else{
            echo "error";
            //$this->render('errors/index');
        }
    }
    public function editT($data,$id){
        $TabFec = $data['date'];
        $TabEst = $data['reserved'];
        $TabEstReg  = $data['state'];
        if(! is_null($id) && !is_null($TabFec) &&!is_null($TabEst) && !is_null($TabEstReg)){
            $r = Tabl::getByIds($id);
            $r->setTabFec($TabFec);
            $r->setTabEst($TabEst);
            $r->setTabEstReg($TabEstReg);
            $r->update();
            $this->render('Tabl/home', ['op'=>3,'response'=>1,'message'=>'update successfuly','Tabl' => $r]);
        }else{
            echo "Error";
        }
    }

    public function viewT($data){
        $r = Tabl::getById($data);
        $this->render('Tabl/home', ['op'=>2,'response'=>1,'message'=>'success','Tabl' => $r]);
    }
    public function deleteT($data){
        $r = Tabl::delete($data);
        $this->render('Tabl/home', ['op'=>4,'response'=>1,'message'=>'delete success']);
    }
}