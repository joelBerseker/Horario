<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class Access extends Model{

    private string $id;
    private int $AccEstReg;
    private $AccFecAct;
    
    public function __construct(
        private string $AccName,
        private int $AccRoleID, 
        private int $AccResID

    )
    {
        parent::__construct();
        $this->AccEstReg=0;
        $this->AccFecAct='';
    }

    /*public static function exists($RoleName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT RoleName FROM Roleduct WHERE RoleName = :RoleName');
            $query->execute( ['RoleName' => $RoleName]);
            
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
            
            $query = $this->prepare('INSERT INTO Access (AccName,AccRoleID,AccResID) VALUES(:AccName,:AccRoleID,:AccResID)');
            $query->execute([
                'AccName'  => $this->AccName, 
                'AccRoleID'  => $this->AccRoleID, 
                'AccResID'  => $this->AccResID, 
            ]);
            return true;
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    }
    public function update(){
        try{
            $query = $this->prepare('UPDATE Access SET AccName =:AccName, AccRoleID =:AccRoleID, AccResID =:AccResID, AccEstReg=:AccEstReg WHERE AccID=:AccID');
            return $query->execute([
                'AccName'  => $this->AccName,
                'AccRoleID'  => $this->AccRoleID,
                'AccResID'  => $this->AccResID,
                'AccEstReg' =>$this->AccEstReg,
                'AccID'=> $this->id,
                ]);
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    } 

    
    public static function get($AccName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM Access WHERE AccName = :AccName');
            $query->execute([ 'AccName' => $AccName]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            error_log($data['AccName']);
            error_log($data['AccRoleID']);
            error_log($data['AccResID']);
            $Access = new Access($data['AccName'],$data['AccRoleID'],$data['AccResID']);
            $Access->setId($data['AccID']);
            return $Access;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function delete($AccID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('DELETE FROM Access WHERE AccID = :AccID');
            if ($query->execute([ 'AccID' => $AccID])){
                return true;
            }
            else
                return false;
        }catch(PDOException $e){
            return false;
        } 
    }
    public static function getById($AccID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM Access WHERE AccID = :AccID');
            $query->execute([ 'AccID' => $AccID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Access = new Access($data['AccName'],$data['AccRoleID'],$data['AccResID']);
            $Access->setId($data['AccID']);
            $Access->setAccRoleID($data['AccRoleID']);
            $Access->setAccResID($data['AccResID']);
            $Access->setAccEstReg($data['AccEstReg']);
            $Access->setAccFecAct($data['AccFecAct']);
            return $Access->toArray();
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getByIds($AccID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM Access WHERE AccID = :AccID');
            $query->execute([ 'AccID' => $AccID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Access = new Access($data['AccName'],$data['AccRoleID'],$data['AccResID']);
            $Access->setId($data['AccID']);
            $Access->setAccRoleID($data['AccRoleID']);
            $Access->setAccResID($data['AccResID']);
            $Access->setAccEstReg($data['AccEstReg']);
            $Access->setAccFecAct($data['AccFecAct']);
            return $Access;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getAll(){
        $items = [];
        try{
            $db = new Database();
            $query = $db->connect()->query('SELECT * FROM Access ORDER BY AccFecAct DESC');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new Access($p['AccName'],$p['AccRoleID'],$p['AccResID']);
                $item->setId($p['AccID']);
                $item->setAccRoleID($p['AccRoleID']);
                $item->setAccResID($p['AccResID']);
                $item->setAccEstReg($p['AccEstReg']);
                $item->setAccFecAct($p['AccFecAct']);
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
    public function getAccEstReg():int{
        return $this->AccEstReg;
    }
    public function setAccEstReg(int $value){
        $this->AccEstReg = $value;
    }
    public function getAccFecAct():string{
        return $this->AccFecAct;
    }
    public function setAccFecAct(string $value){
        $this->AccFecAct = $value;
    }
    public function toArray():array{
        $arr = array("id"=>$this->id,"name"=>$this->AccName,"roleid"=>$this->AccRoleID,"resid"=>$this->AccResID,"state"=>$this->AccEstReg,"UpdateDate"=>$this->AccFecAct);
        return $arr;
    }
    public function getAccName(){
        return $this->AccName;
    }
    public function setAccName($value){
        $this->AccName = $value;
    }
    public function getAccRoleID(){
        return $this->AccRoleID;
    }
    public function setAccRoleID($value){
        $this->AccRoleID = $value;
    }
    public function getAccResID(){
        return $this->AccResID;
    }
    public function setAccResID($value){
        $this->AccResID = $value;
    }
}