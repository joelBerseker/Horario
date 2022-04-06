<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class TypeProduct extends Model{

    private string $id;
    private int $TypeProEstReg;
    private $TypeProFecAct;
    private string $TypeProImg;

    public function __construct(
        private string $TypeProName,
        private string $TypeProDes
    )
    {
        parent::__construct();
        $this->TypeProImg = '';
        $this->TypeProEstReg=0;
        $this->TypeProFecAct='';
    }

    /*public static function exists($TypeProName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT TypeProName FROM typeproduct WHERE TypeProName = :TypeProName');
            $query->execute( ['TypeProName' => $TypeProName]);
            
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
            
            $query = $this->prepare('INSERT INTO typeproduct (TypeProName, TypeProDes, TypeProImg) VALUES(:TypeProName, :TypeProDes, :TypeProImg)');
            $query->execute([
                'TypeProName'  => $this->TypeProName, 
                'TypeProDes'  => $this->TypeProDes,
                'TypeProImg'  => $this->TypeProImg,
                ]);
            return true;
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    }
    public function update(){
        try{
            $query = $this->prepare('UPDATE typeproduct SET TypeProName =:TypeProName, TypeProDes=:TypeProDes, TypeProImg= :TypeProImg, TypeProEstReg=:TypeProEstReg WHERE TypeProID=:TypeProID');
            return $query->execute([
                'TypeProName'  => $this->TypeProName, 
                'TypeProDes'  => $this->TypeProDes,
                'TypeProImg'  => $this->TypeProImg,
                'TypeProEstReg' =>$this->TypeProEstReg,
                'TypeProID'=> $this->id,
                ]);
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    } 

    
    public static function get($TypeProName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM typeproduct WHERE TypeProName = :TypeProName');
            $query->execute([ 'TypeProName' => $TypeProName]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            error_log($data['TypeProName']);
            error_log($data['TypeProDes']);
            $typeProduct = new TypeProduct($data['TypeProName'], $data['TypeProDes']);
            $typeProduct->setId($data['TypeProID']);
            $typeProduct->setTypeProImg($data['TypeProImg']);
            return $typeProduct;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function delete($TypeProID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('DELETE FROM typeproduct WHERE TypeProID = :TypeProID');
            if ($query->execute([ 'TypeProID' => $TypeProID])){
                return true;
            }
            else
                return false;
        }catch(PDOException $e){
            return false;
        } 
    }
    public static function getById($TypeProID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM typeproduct WHERE TypeProID = :TypeProID');
            $query->execute([ 'TypeProID' => $TypeProID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $typeProduct = new TypeProduct($data['TypeProName'], $data['TypeProDes']);
            $typeProduct->setId($data['TypeProID']);
            $typeProduct->setTypeProImg($data['TypeProImg']);
            $typeProduct->setTypeProEstReg($data['TypeProEstReg']);
            $typeProduct->setTypeProFecAct($data['TypeProFecAct']);
            return $typeProduct->toArray();
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getByIds($TypeProID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM typeproduct WHERE TypeProID = :TypeProID');
            $query->execute([ 'TypeProID' => $TypeProID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $typeProduct = new TypeProduct($data['TypeProName'], $data['TypeProDes']);
            $typeProduct->setId($data['TypeProID']);
            $typeProduct->setTypeProImg($data['TypeProImg']);
            $typeProduct->setTypeProEstReg($data['TypeProEstReg']);
            $typeProduct->setTypeProFecAct($data['TypeProFecAct']);
            return $typeProduct;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getAll(){
        $items = [];
        try{
            $db = new Database();
            $query = $db->connect()->query('SELECT * FROM typeproduct ORDER BY TypeProFecAct DESC');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new TypeProduct($p['TypeProName'], $p['TypeProDes']);
                $item->setId($p['TypeProID']);
                $item->setTypeProImg($p['TypeProImg']);
                $item->setTypeProEstReg($p['TypeProEstReg']);
                $item->setTypeProFecAct($p['TypeProFecAct']);
                
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
    public function getTypeProEstReg():int{
        return $this->TypeProEstReg;
    }
    public function setTypeProEstReg(int $value){
        $this->TypeProEstReg = $value;
    }
    public function getTypeProFecAct():string{
        return $this->TypeProFecAct;
    }
    public function setTypeProFecAct(string $value){
        $this->TypeProFecAct = $value;
    }
    public function toArray():array{
        $arr = array("id"=>$this->id,"name"=>$this->TypeProName,"image"=>$this->TypeProImg,"description"=>$this->TypeProDes,"state"=>$this->TypeProEstReg,"UpdateDate"=>$this->TypeProFecAct);
        return $arr;
    }
    public function getTypeProName(){
        return $this->TypeProName;
    }
    public function setTypeProName($value){
        $this->TypeProName = $value;
    }
    public function getTypeProDes(){
        return $this->TypeProDes;
    }
    public function setTypeProDes($value){
        $this->TypeProDes = $value;
    }

    public function setTypeProImg($value){
        $this->TypeProImg = $value;
    }

    public function getTypeProImg(){
        return $this->TypeProImg;
    }
}