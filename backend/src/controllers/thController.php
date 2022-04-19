<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\models\TicketHeader;


class thController extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function thindex(){
        //acl true
        $r = TicketHeader::getAll();
        $this->render('TicketHeader/home', ['op'=>0,'response'=>1,'message'=>'success','ticketheader' => $r]);
    }
    public function addTH($data){
        $TicHeadUserID = $data['userid'];
        $TicHeadTabID = $data['tabid'];
        $TicHeadFec = $data['fecha'];
        $TicHeadRUC = $data['ruc'];
        $TicHeadLocName = $data['localname'];
        $TicHeadPorDesc = $data['perdesc'];
        if(!is_null($TicHeadUserID) && !is_null($TicHeadTabID) &&!is_null($TicHeadFec) &&!is_null($TicHeadRUC) &&!is_null($TicHeadLocName)){
            $r = new TicketHeader($TicHeadUserID,$TicHeadTabID,$TicHeadFec,$TicHeadRUC,$TicHeadLocName);
            if(!is_null($TicHeadPorDesc)){
                $r->setTicHeadPorDesc($TicHeadPorDesc);
            }
            $r->save();
            $this->render('TicketHeader/home', ['op'=>1,'response'=>1,'message'=>'add successfuly']);
        }else{
            echo "error";
            //$this->render('errors/index');
        }
    }
    public function editTH($data,$id){
        $TicHeadUserID = $data['userid'];
        $TicHeadTabID = $data['tabid'];
        $TicHeadFec = $data['fecha'];
        $TicHeadRUC = $data['ruc'];
        $TicHeadLocName = $data['localname'];
        $TicHeadPorDesc = $data['perdesc'];
        $TicHeadEstReg  = $data['state'];
        if(! is_null($id) && !is_null($TicHeadUserID)&& !is_null($TicHeadTabID) &&!is_null($TicHeadFec) &&!is_null($TicHeadRUC) &&!is_null($TicHeadLocName) && !is_null($TicHeadEstReg)){
            $r = TicketHeader::getByIds($id);
            $r->setTicHeadUserID($TicHeadUserID);
            $r->setTicHeadTabID($TicHeadTabID);
            $r->setTicHeadFec($TicHeadFec);
            $r->setTicHeadRUC($TicHeadRUC);
            $r->setTicHeadLocName($TicHeadLocName);
            $r->setTicHeadEstReg($TicHeadEstReg);
            if(!is_null($TicHeadPorDesc)){
                $r->setTicHeadPorDesc($TicHeadPorDesc);
            }
            $r->update();
            $this->render('TicketHeader/home', ['op'=>3,'response'=>1,'message'=>'update successfuly','ticketheader' => $r->toArray()]);
        }else{
            echo "Error";
        }
    }

    public function viewTH($data){
        $r = TicketHeader::getById($data);
        $this->render('TicketHeader/home', ['op'=>2,'response'=>1,'message'=>'success','ticketheader' => $r]);
    }
    public function deleteTH($data){
        $r = TicketHeader::delete($data);
        $this->render('TicketHeader/home', ['op'=>4,'response'=>1,'message'=>'delete success']);
    }
}