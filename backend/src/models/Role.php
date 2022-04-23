<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class Role extends Model{

    private string $id;
    private int $RoleEstReg;
    private $RoleFecAct;
    
    public function __construct(
        private string $RoleName
    )
    {
        parent::__construct();
        $this->RoleEstReg=0;
        $this->RoleFecAct='';
    }

    public function save(){
        try{
            $query = $this->prepare('INSERT INTO role (RoleName) VALUES(:RoleName)');
            $query->execute([
                'RoleName'  => $this->RoleName, 
            ]);
            $NewRole =  Role::get_inArray($this->RoleName);
            $NewRoleID = $NewRole['id'];
            $resources = Resource::getAll();
            for ($i = 0; $i < count($resources); $i++) {
                $auxq = $this->prepare('INSERT INTO Access (AccRoleID,AccResID,AccPer) VALUES(:AccRoleID,:AccResID,:AccPer)');
                $auxq->execute([
                    'AccPer'  => 1, 
                    'AccRoleID'  => $NewRoleID, 
                    'AccResID'  => $resources[$i]['id'], 
                ]);
            }
            
            return true;
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    }

    public static function exists($RoleName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT RoleName FROM role WHERE RoleName = :RoleName');
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
    }

    public function update(){
        try{
            $query = $this->prepare('UPDATE role SET RoleName =:RoleName, RoleEstReg=:RoleEstReg WHERE RoleID=:RoleID');
            return $query->execute([
                'RoleName'  => $this->RoleName, 
                'RoleEstReg' =>$this->RoleEstReg,
                'RoleID'=> $this->id,
                ]);
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    } 

    
    public static function get($RoleName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM role WHERE RoleName = :RoleName');
            $query->execute([ 'RoleName' => $RoleName]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            error_log($data['RoleName']);
            $Role = new Role($data['RoleName']);
            $Role->setId($data['RoleID']);
            return $Role;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function get_inArray($RoleName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM role WHERE RoleName = :RoleName');
            $query->execute([ 'RoleName' => $RoleName]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            error_log($data['RoleName']);
            $Role = new Role($data['RoleName']);
            $Role->setId($data['RoleID']);
            return $Role->toArray();
        }catch(PDOException $e){
            return false;
        }
    }
    public static function delete($RoleID){
        try{
            $db = new Database();
            $query1 = $db->connect()->prepare('DELETE FROM access WHERE AccRoleID = :AccRoleID');
            if ($query1->execute([ 'AccRoleID' => $RoleID])){
                $query2 = $db->connect()->prepare('DELETE FROM role WHERE RoleID = :RoleID');
                if ($query2->execute([ 'RoleID' => $RoleID])){
                    return true;
                }
                else{
                    return false;
                }
            }             
        }catch(PDOException $e){
            return false;
        } 
    }
    public static function getById($RoleID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM role WHERE RoleID = :RoleID');
            $query->execute([ 'RoleID' => $RoleID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Role = new Role($data['RoleName']);
            $Role->setId($data['RoleID']);
            $Role->setRoleEstReg($data['RoleEstReg']);
            $Role->setRoleFecAct($data['RoleFecAct']);
            return $Role->toArray();
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getByIds($RoleID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM role WHERE RoleID = :RoleID');
            $query->execute([ 'RoleID' => $RoleID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $Role = new Role($data['RoleName']);
            $Role->setId($data['RoleID']);
            $Role->setRoleEstReg($data['RoleEstReg']);
            $Role->setRoleFecAct($data['RoleFecAct']);
            return $Role;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getAll(){
        $items = [];
        try{
            $db = new Database();
            $query = $db->connect()->query('SELECT * FROM Role ORDER BY RoleFecAct');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new Role($p['RoleName']);
                $item->setId($p['RoleID']);
                $item->setRoleEstReg($p['RoleEstReg']);
                $item->setRoleFecAct($p['RoleFecAct']);
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
    public function getRoleEstReg():int{
        return $this->RoleEstReg;
    }
    public function setRoleEstReg(int $value){
        $this->RoleEstReg = $value;
    }
    public function getRoleFecAct():string{
        return $this->RoleFecAct;
    }
    public function setRoleFecAct(string $value){
        $this->RoleFecAct = $value;
    }
    public function toArray():array{
        $arr = array("id"=>$this->id,"name"=>$this->RoleName,"state"=>$this->RoleEstReg,"UpdateDate"=>$this->RoleFecAct);
        return $arr;
    }
    public function getRoleName(){
        return $this->RoleName;
    }
    public function setRoleName($value){
        $this->RoleName = $value;
    }
}