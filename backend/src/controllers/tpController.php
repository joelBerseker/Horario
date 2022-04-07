<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\lib\UtilImages;
use User\Backend\models\TypeProduct;


class tpController extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function index(){
        //acl true
        $tp = TypeProduct::getAll();
        $this->render('TypeProduct/home', ['op'=>0,'response'=>1,'message'=>'success','typeProducts' => $tp]);
    }
    public function addTP($data,$file){
        $TypeProName = $data['name'];
        $TypeProDes = $data['description'];
        $TypeProImg = $file['image'];
        if(!is_null($TypeProName) && !is_null($TypeProDes)){
            $typep = new TypeProduct($TypeProName,$TypeProDes);
            
            if(file_exists($TypeProImg['tmp_name'][0])){
                echo "hola";
                $url = UtilImages::storeImage("typeproduct/",$TypeProImg);
                $typep->setTypeProImg($url);
            }
            $typep->save();
            $this->render('TypeProduct/home', ['op'=>1,'response'=>1,'message'=>'add successfuly']);
        }else{
            echo "error";
            //$this->render('errors/index');
        }
    }
    public function editTP($data,$file,$id){
        $TypeProName    = $data['name'];
        $TypeProDes     = $data['description'];
        $TypeProEstReg  = $data['state'];
        $TypeProImg = $file['image'];
        if(! is_null($id) && !is_null($TypeProName) && !is_null($TypeProDes)&& !is_null($TypeProEstReg)){
            $typep = TypeProduct::getByIds($id);
            if(file_exists($TypeProImg['tmp_name'][0])){
                echo "hola";
                $url = UtilImages::storeImage("typeproduct/",$TypeProImg);
                $typep->setTypeProImg($url);
            }
            $typep->setTypeProName($TypeProName);
            $typep->setTypeProEstReg($TypeProEstReg);
            $typep->setTypeProDes($TypeProDes);
            $typep->update();
            $this->render('TypeProduct/home', ['op'=>3,'response'=>1,'message'=>'update successfuly','typeProduct' => $typep->toArray()]);
        }else{
            echo "Error por puto ".$id." -> ".$TypeProName." -> ".$TypeProDes;
        }
    }

    public function viewTP($data){
        $typep = TypeProduct::getById($data);
        $this->render('TypeProduct/home', ['op'=>2,'response'=>1,'message'=>'success','typeProduct' => $typep]);
    }
    public function deleteTP($data){
        $typep = TypeProduct::delete($data);
        $this->render('TypeProduct/home', ['op'=>4,'response'=>1,'message'=>'delete success']);
    }

    /*public function store(){

        $title = $this->post('title');
        $image = $this->file('image');

        if(!is_null($title) && !is_null($image)){
            $url = UtilImages::storeImage($image);
            if(!is_null($url)){
                error_log($title);
                error_log($url);
                $post = new PostImage($title, $url);
                $this->user->publish($post);
            }
        }
    }*/
}