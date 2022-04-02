<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\models\TicketDetail;


class tdController extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function tdindex(){
        //acl true
        $r = TicketDetail::getAll();
        $this->render('TicketDetail/home', ['op'=>0,'response'=>1,'message'=>'success','ticketdetail' => $r]);
    }
    public function addTD($data){
        $TicDetTicHeadID = $data['thid'];
        $TicDetProID = $data['productid'];
        $TicDetDes = $data['description'];
        $TicDetCant = $data['quantity'];
        if(!is_null($TicDetTicHeadID) &&!is_null($TicDetProID) &&!is_null($TicDetDes) &&!is_null($TicDetCant)){
            $r = new TicketDetail($TicDetTicHeadID,$TicDetProID,$TicDetDes,$TicDetCant);
            $r->save();
            $this->render('TicketDetail/home', ['op'=>1,'response'=>1,'message'=>'add successfuly']);
        }else{
            echo "error";
            //$this->render('errors/index');
        }
    }
    public function editTD($data,$id){
        $TicDetTicHeadID = $data['thid'];
        $TicDetProID = $data['productid'];
        $TicDetDes = $data['description'];
        $TicDetCant = $data['quantity'];
        $TicDetEstReg  = $data['state'];
        if(! is_null($id) && !is_null($TicDetTicHeadID) &&!is_null($TicDetProID) &&!is_null($TicDetDes) &&!is_null($TicDetCant) && !is_null($TicDetEstReg)){
            $r = TicketDetail::getByIds($id);
            $r->setTicDetTicHeadID($TicDetTicHeadID);
            $r->setTicDetProID($TicDetProID);
            $r->setTicDetDes($TicDetDes);
            $r->setTicDetCant($TicDetCant);
            $r->setTicDetEstReg($TicDetEstReg);
            $r->update();
            $this->render('TicketDetail/home', ['op'=>3,'response'=>1,'message'=>'update successfuly','ticketdetail' => $r]);
        }else{
            echo "Error";
        }
    }

    public function viewTD($data){
        $r = TicketDetail::getById($data);
        $this->render('TicketDetail/home', ['op'=>2,'response'=>1,'message'=>'success','ticketdetail' => $r]);
    }
    public function deleteTD($data){
        $r = TicketDetail::delete($data);
        $this->render('TicketDetail/home', ['op'=>4,'response'=>1,'message'=>'delete success']);
    }
}