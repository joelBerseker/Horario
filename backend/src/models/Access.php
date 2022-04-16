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
        private int $AccRoleID, 
        private int $AccResID,
        private int $AccPer
    )
    {
        parent::__construct();
        $this->AccEstReg=0;
        $this->AccFecAct='';
    }
    /**
     * @description Guardar Datos
     * 
     */
    public function save(){
        try{
            
            $query = $this->prepare('INSERT INTO Access (AccPer,AccRoleID,AccResID) VALUES(:AccPer,:AccRoleID,:AccResID)');
            $query->execute([
                'AccPer'  => $this->AccPer, 
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
            $query = $this->prepare('UPDATE Access SET AccPer =:AccPer, AccRoleID =:AccRoleID, AccResID =:AccResID, AccEstReg=:AccEstReg WHERE AccID=:AccID');
            return $query->execute([
                'AccPer'  => $this->AccPer,
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

    
    public static function get($AccPer){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM Access WHERE AccPer = :AccPer');
            $query->execute([ 'AccPer' => $AccPer]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            error_log($data['AccPer']);
            error_log($data['AccRoleID']);
            error_log($data['AccResID']);
            $Access = new Access($data['AccPer'],$data['AccRoleID'],$data['AccResID']);
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
            $Access = new Access($data['AccPer'],$data['AccRoleID'],$data['AccResID']);
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
            $Access = new Access($data['AccPer'],$data['AccRoleID'],$data['AccResID']);
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
                $item = new Access($p['AccPer'],$p['AccRoleID'],$p['AccResID']);
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
        $arr = array("id"=>$this->id,"permise"=>$this->AccPer,"roleid"=>$this->AccRoleID,"resid"=>$this->AccResID,"state"=>$this->AccEstReg);
        return $arr;
    }
    public function getAccPer(){
        return $this->AccPer;
    }
    public function setAccPer($value){
        $this->AccPer = $value;
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