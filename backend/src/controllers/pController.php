<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\lib\UtilImages;
use User\Backend\models\Product;


class pController extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function pindex(){
        //acl true
        $r = Product::getAll();
        $this->render('Product/home', ['op'=>0,'response'=>1,'message'=>'success','Products' => $r]);
    }
    public function addP($data,$file){
        $ProName = $data['name'];
        $ProDes = $data['description'];
        $ProPre = $data['price'];
        $ProTypeProID = $data['typeproid'];
        $ProImg = $file['image'];
        if(!is_null($ProName) && !is_null($ProDes) && !is_null($ProPre) && !is_null($ProTypeProID)){
            $typep = new Product($ProName,$ProDes,$ProTypeProID,$ProPre);
            if(file_exists($ProImg['tmp_name'])){
                $url = UtilImages::storeImage("product/",$ProImg);
                $typep->setProImg($url);
            }
            $typep->save();
           $this->render('Product/home', ['op'=>1,'response'=>1,'message'=>'add successfuly']);
        }else{
            echo "error";
            //$this->render('errors/index');
        }
    }
    public function editP($data,$file,$id){
        $ProName = $data['name'];
        $ProDes = $data['description'];
        $ProPre = $data['price'];
        $ProProm = $data['promotion'];
        $ProTypeProID = $data['typeproid'];
        $ProImg = $file['image'];
        $ProEstReg  = $data['state'];
        if(! is_null($id) && !is_null($ProName) && !is_null($ProDes) && !is_null($ProProm) && !is_null($ProPre) && !is_null($ProTypeProID) && !is_null($ProEstReg)){
            $p = Product::getByIds($id);
            if(!isset($ProImg['tmp_name'])){
                $url = UtilImages::storeImage("product/",$ProImg);
                $p->setProImg($url);
            }
            $p->setProName($ProName);
            $p->setProTypeProID($ProTypeProID);
            $p->setProEstReg($ProEstReg);
            $p->setProDes($ProDes);
            $p->setProProm($ProProm);
            $p->setProPre($ProPre);
            $p->update();
            $this->render('Product/home', ['op'=>3,'response'=>1,'message'=>'update successfuly','Product' => $p]);
        }else{
            echo "Error";
        }
    }

    public function viewP($data){
        $r = Product::getById($data);
        $this->render('Product/home', ['op'=>2,'response'=>1,'message'=>'success','product' => $r]);
    }
    public function deleteP($data){
        $r = Product::delete($data);
        $this->render('Product/home', ['op'=>4,'response'=>1,'message'=>'delete success']);
    }
}