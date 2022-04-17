<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class Tabl extends Model{

    private int $TabEst;
    private int $TabEstReg;
    private $TabFecAct;
    private $TabFecHour;
    
    public function __construct(
        private string $id
    )
    {
        parent::__construct();
        //TabEst : 1=libre 2=ocupado 3=reservado
        $this->TabEst=0;
        $this->TabEstReg=0;
        $this->TabFecAct='';
        $this->TabFecHour='';
    }

    
    public function save(){
        try{
            $query = $this->prepare('INSERT INTO Tabl (TabID) VALUES(:TabID)');
            $query->execute([
                'TabID'  => $this->id, 
            ]);
            return true;
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    }
    public function update(){
        try{
            $query = $this->prepare('UPDATE Tabl SET TabFecHour =:TabFecHour, TabEst =:TabEst, TabEstReg=:TabEstReg WHERE TabID=:TabID');
            return $query->execute([
                'TabEst'  => $this->TabEst, 
                'TabEstReg' =>$this->TabEstReg,
                'TabFecHour' =>$this->TabFec,
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
            $query = $db->connect()->prepare('SELECT * FROM tabl WHERE TabID = :TabID');
            $query->execute([ 'TabID' => $TabID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Tab = new Tabl($data['TabID']);
            $Tab->setTabEstReg($data['TabEstReg']);
            $Tab->setTabEst($data['TabEst']);
            $Tab->setTabFecHour($data['TabFecHour']);
            $Tab->setTabFecAct($data['TabFecAct']);
            return $Tab->toArray();
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getByIds($TabID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM tabl WHERE TabID = :TabID');
            $query->execute([ 'TabID' => $TabID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Tab = new Tabl($data['TabID']);
            $Tab->setTabEstReg($data['TabEstReg']);
            $Tab->setTabEst($data['TabEst']);
            $Tab->setTabFecHour($data['TabFecHour']);
            $Tab->setTabFecAct($data['TabFecAct']);
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
                $item = new Tabl($p['TabID']);
                $item->setTabEst($p['TabEst']);
                $item->setTabEstReg($p['TabEstReg']);
                $item->setTabFecAct($p['TabFecAct']);
                $item->setTabFecHour($p['TabFecHour']);
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
    }
    public function getTabFecHour():string{
        return $this->TabFecHour;
    }
    public function setTabFecHour(string $value){
        $this->TabFecHour = $value;
    }
    public function toArray():array{
        $arr = array("id"=>$this->id,"hour"=>$this->TabFecHour,"reserved"=>$this->TabEst,"state"=>$this->TabEstReg,"UpdateDate"=>$this->TabFecAct);
        return $arr;
    }
    public function getTabEst(){
        return $this->TabEst;
    }
    public function setTabEst($value){
        $this->TabEst = $value;
    }
}