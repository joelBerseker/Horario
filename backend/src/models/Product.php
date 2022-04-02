<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class Product extends Model{

    private string $id;
    private int $ProEstReg;
    private $ProFecAct;
    private string $ProImg;

    public function __construct(
        private string $ProName,
        private string $ProDes
    )
    {
        parent::__construct();
        $this->ProImg = '';
        $this->ProEstReg=0;
        $this->ProFecAct='';
    }

    /*public static function exists($ProName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT ProName FROM product WHERE ProName = :ProName');
            $query->execute( ['ProName' => $ProName]);
            
            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }*/

   
    /**
     * @description Guardar Datos
     * 
     */
    public function save(){
        try{
            
            $query = $this->prepare('INSERT INTO product (ProName, ProDes, ProImg) VALUES(:ProName, :ProDes, :ProImg)');
            $query->execute([
                'ProName'  => $this->ProName, 
                'ProDes'  => $this->ProDes,
                'ProImg'  => $this->ProImg,
                ]);
            return true;
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    }
    public function update(){
        try{
            $query = $this->prepare('UPDATE product SET ProName =:ProName, ProDes=:ProDes, ProImg= :ProImg, ProEstReg=:ProEstReg WHERE ProID=:ProID');
            return $query->execute([
                'ProName'  => $this->ProName, 
                'ProDes'  => $this->ProDes,
                'ProImg'  => $this->ProImg,
                'ProEstReg' =>$this->ProEstReg,
                'ProID'=> $this->id,
                ]);
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    } 

    
    public static function get($ProName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM product WHERE ProName = :ProName');
            $query->execute([ 'ProName' => $ProName]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            error_log($data['ProName']);
            error_log($data['ProDes']);
            $Product = new Product($data['ProName'], $data['ProDes']);
            $Product->setId($data['ProID']);
            $Product->setProImg($data['ProImg']);
            return $Product;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function delete($ProID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('DELETE FROM product WHERE ProID = :ProID');
            if ($query->execute([ 'ProID' => $ProID])){
                return true;
            }
            else
                return false;
        }catch(PDOException $e){
            echo "yo falso";
            return false;
        } 
    }
    public static function getById($ProID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM product WHERE ProID = :ProID');
            $query->execute([ 'ProID' => $ProID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Product = new Product($data['ProName'], $data['ProDes']);
            $Product->setId($data['ProID']);
            $Product->setProImg($data['ProImg']);
            $Product->setProEstReg($data['ProEstReg']);
            $Product->setProFecAct($data['ProFecAct']);
            return $Product->toArray();
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getByIds($ProID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM product WHERE ProID = :ProID');
            $query->execute([ 'ProID' => $ProID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Product = new Product($data['ProName'], $data['ProDes']);
            $Product->setId($data['ProID']);
            $Product->setProImg($data['ProImg']);
            $Product->setProEstReg($data['ProEstReg']);
            $Product->setProFecAct($data['ProFecAct']);
            return $Product;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getAll(){
        $items = [];
        try{
            $db = new Database();
            $query = $db->connect()->query('SELECT * FROM product ORDER BY ProFecAct DESC');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new Product($p['ProName'], $p['ProDes']);
                $item->setId($p['ProID']);
                $item->setProImg($p['ProImg']);
                $item->setProEstReg($p['ProEstReg']);
                $item->setProFecAct($p['ProFecAct']);
                
                array_push($items, $item->toArray());
            }
            return $items;
        }catch(PDOException $e){
            echo "error";
            echo $e;
        }
    }

    public function getId():string{
        return $this->id;
    }

    public function setId(string $value){
        $this->id = $value;
    }
    public function getProEstReg():int{
        return $this->ProEstReg;
    }
    public function setProEstReg(int $value){
        $this->ProEstReg = $value;
    }
    public function getProFecAct():string{
        return $this->ProFecAct;
    }
    public function setProFecAct(string $value){
        $this->ProFecAct = $value;
    }
    public function toArray():array{
        $arr = array("id"=>$this->id,"name"=>$this->ProName,"image"=>$this->ProImg,"description"=>$this->ProDes,"state"=>$this->ProEstReg,"UpdateDate"=>$this->ProFecAct);
        return $arr;
    }
    public function getProName(){
        return $this->ProName;
    }
    public function setProName($value){
        $this->ProName = $value;
    }
    public function getProDes(){
        return $this->ProDes;
    }
    public function setProDes($value){
        $this->ProDes = $value;
    }

    public function setProImg($value){
        $this->ProImg = $value;
    }

    public function getProImg(){
        return $this->ProImg;
    }
}