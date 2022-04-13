<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class Tabl extends Model{

    private string $id;
    private int $TabEstReg;
    private $TabFecAct;
    private $TabFec;
    
    public function __construct(
        private string $TabEst
    )
    {
        parent::__construct();
        $this->TabEstReg=0;
        $this->TabFecAct='';
        $this->TabFec='';
    }

    
    public function save(){
        try{
            
            $query = $this->prepare('INSERT INTO Tabl (TabEst) VALUES(:TabEst)');
            $query->execute([
                'TabEst'  => $this->TabEst, 
            ]);
            return true;
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    }
    public function update(){
        try{
            $query = $this->prepare('UPDATE Tabl SET TabEst =:TabEst, TabFec =:TabFec, TabEstReg=:TabEstReg WHERE TabID=:TabID');
            return $query->execute([
                'TabEst'  => $this->TabEst, 
                'TabEstReg' =>$this->TabEstReg,
                'TabFec' =>$this->TabFec,
                'TabID'=> $this->id,
                ]);
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    } 

    
    public static function delete($TabID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('DELETE FROM Tabl WHERE TabID = :TabID');
            if ($query->execute([ 'TabID' => $TabID])){
                return true;
            }
            else
                return false;
        }catch(PDOException $e){
            return false;
        } 
    }
    public static function getById($TabID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM Tabl WHERE TabID = :TabID');
            $query->execute([ 'TabID' => $TabID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Tab = new Tab($data['TabEst']);
            $Tab->setId($data['TabID']);
            $Tab->setTabEstReg($data['TabEstReg']);
            $Tab->setTabFecAct($data['TabFecAct']);
            $Tab->setTabFec($data['TabFec']);
            return $Tab->toArray();
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getByIds($TabID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM Tabl WHERE TabID = :TabID');
            $query->execute([ 'TabID' => $TabID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Tab = new Tab($data['TabEst']);
            $Tab->setId($data['TabID']);
            $Tab->setTabEstReg($data['TabEstReg']);
            $Tab->setTabFecAct($data['TabFecAct']);
            $Tab->setTabFec($data['TabFec']);
            return $Tab;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getAll(){
        $items = [];
        try{
            $db = new Database();
            $query = $db->connect()->query('SELECT * FROM Tabl ORDER BY TabFecAct DESC');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new Tab($p['TabEst']);
                $item->setId($p['TabID']);
                $item->setTabEstReg($p['TabEstReg']);
                $item->setTabFecAct($p['TabFecAct']);
                $item->setTabFec($p['TabFec']);
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
    public function getTabEstReg():int{
        return $this->TabEstReg;
    }
    public function setTabEstReg(int $value){
        $this->TabEstReg = $value;
    }
    public function getTabFecAct():string{
        return $this->TabFecAct;
    }
    public function setTabFecAct(string $value){
        $this->TabFecAct = $value;
    }public function getTabFec():string{
        return $this->TabFec;
    }
    public function setTabFec(string $value){
        $this->TabFec = $value;
    }
    public function toArray():array{
        $arr = array("id"=>$this->id,"name"=>$this->TabEst,"state"=>$this->TabEstReg,"reserved"=>$this->TabFec,"UpdateDate"=>$this->TabFecAct);
        return $arr;
    }
    public function getTabEst(){
        return $this->TabEst;
    }
    public function setTabEst($value){
        $this->TabEst = $value;
    }
}