<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class Resource extends Model{

    private string $id;
    private int $ResEstReg;
    private $ResFecAct;
    
    public function __construct(
        private string $ResName
    )
    {
        parent::__construct();
        $this->ResEstReg=0;
        $this->ResFecAct='';
    }
    
    public function save(){
        try{
            
            $query = $this->prepare('INSERT INTO resource (ResName) VALUES(:ResName)');
            $query->execute([
                'ResName'  => $this->ResName, 
            ]);
            return true;
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    }
    public function update(){
        try{
            $query = $this->prepare('UPDATE resource SET ResName =:ResName, ResEstReg=:ResEstReg WHERE ResID=:ResID');
            return $query->execute([
                'ResName'  => $this->ResName, 
                'ResEstReg' =>$this->ResEstReg,
                'ResID'=> $this->id,
                ]);
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    } 

    
    public static function get($ResName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM resource WHERE ResName = :ResName');
            $query->execute([ 'ResName' => $ResName]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            error_log($data['ResName']);
            $Resource = new Resource($data['ResName']);
            $Resource->setId($data['ResID']);
            return $Resource;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function delete($ResID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('DELETE FROM resource WHERE ResID = :ResID');
            if ($query->execute([ 'ResID' => $ResID])){
                return true;
            }
            else
                return false;
        }catch(PDOException $e){
            return false;
        } 
    }
    public static function getById($ResID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM resource WHERE ResID = :ResID');
            $query->execute([ 'ResID' => $ResID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Resource = new Resource($data['ResName']);
            $Resource->setId($data['ResID']);
            $Resource->setResEstReg($data['ResEstReg']);
            $Resource->setResFecAct($data['ResFecAct']);
            return $Resource->toArray();
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getByIds($ResID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM resource WHERE ResID = :ResID');
            $query->execute([ 'ResID' => $ResID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Resource = new Resource($data['ResName']);
            $Resource->setId($data['ResID']);
            $Resource->setResEstReg($data['ResEstReg']);
            $Resource->setResFecAct($data['ResFecAct']);
            return $Resource;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getAll(){
        $items = [];
        try{
            $db = new Database();
            $query = $db->connect()->query('SELECT * FROM Resource ORDER BY ResFecAct DESC');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new Resource($p['ResName']);
                $item->setId($p['ResID']);
                $item->setResEstReg($p['ResEstReg']);
                $item->setResFecAct($p['ResFecAct']);
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
    public function getResEstReg():int{
        return $this->ResEstReg;
    }
    public function setResEstReg(int $value){
        $this->ResEstReg = $value;
    }
    public function getResFecAct():string{
        return $this->ResFecAct;
    }
    public function setResFecAct(string $value){
        $this->ResFecAct = $value;
    }
    public function toArray():array{
        $arr = array("id"=>$this->id,"name"=>$this->ResName,"state"=>$this->ResEstReg,"UpdateDate"=>$this->ResFecAct);
        return $arr;
    }
    public function getResName(){
        return $this->ResName;
    }
    public function setResName($value){
        $this->ResName = $value;
    }
}