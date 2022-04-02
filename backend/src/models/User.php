<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class User extends Model{

    private string $id;
    private int $UserEstReg;
    private $UserFecAct;

    public function __construct(
        private int $UserRoleID,
        private string $UserName,
        private string $UserNickName,
        private string $UserPass,
    )
    {
        parent::__construct();
        $this->UserEstReg=0;
        $this->UserFecAct='';
    }

    private function getHashedPassword($password){
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }

    public function save(){
        try{
            $hash = $this->getHashedPassword($this->UserPass);
            $query = $this->prepare('INSERT INTO User (UserRoleID, UserName, UserNickName, UserPass) VALUES(:UserRoleID, :UserName, :UserNickName, :UserPass)');
            $query->execute([
                'UserRoleID'  => $this->UserRoleID, 
                'UserName'  => $this->UserName, 
                'UserNickName'  => $this->UserNickName, 
                'UserPass'  => $hash,
                ]);
            return true;
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    } 

    public function update(){
        try{
            $hash = $this->getHashedPassword($this->UserPass);
            $query = $this->prepare('UPDATE User SET UserRoleID =:UserRoleID, UserName =:UserName, UserNickName =:UserNickName, UserPass =:UserPass, UserEstReg=:UserEstReg WHERE UserID=:UserID');
            return $query->execute([
                'UserRoleID'  => $this->UserRoleID,
                'UserName'  => $this->UserName,
                'UserNickName'  => $this->UserNickName,
                'UserPass'  => $this->hash,
                'UserEstReg' =>$this->UserEstReg,
                'UserID'=> $this->id,
                ]);
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    } 

    public static function get($UserName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM user WHERE UserName = :UserName');
            $query->execute([ 'UserName' => $UserName]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            error_log($data['UserRoleID']);
            error_log($data['UserName']);
            error_log($data['UserNickName']);
            error_log($data['UserPass']);
            $user = new User($data['UserRoleID'], $data['UserName'],$data['UserRoleID'], $data['UserPass']);
            $user->setId($data['UserID']);
            $user->setUserRoleID($data['UserRoleID']);
            $user->setUserNickName($data['UserNickName']);
            $user->setUserPass($data['UserPass']);
            return $user;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function delete($UserID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('DELETE FROM User WHERE UserID = :UserID');
            if ($query->execute([ 'UserID' => $UserID])){
                return true;
            }
            else
                return false;
        }catch(PDOException $e){
            return false;
        } 
    }
    public static function getById($UserID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM user WHERE UserID = :UserID');
            $query->execute([ 'UserID' => $UserID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $user = new User($data['UserRoleID'], $data['UserName'],$data['UserNickName'],$data['UserPass']);
            $user->setId($data['UserID']);
            $user->setUserRoleID($data['UserRoleID']);
            $user->setUserNickName($data['UserNickName']);
            $user->setUserPass($data['UserPass']);
            $user->setUserEstReg($data['UserEstReg']);
            $user->setUserFecAct($data['UserFecAct']);
            return $user->toArray();
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getByIds($UserID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM user WHERE UserID = :UserID');
            $query->execute([ 'UserID' => $UserID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $user = new User($data['UserRoleID'], $data['UserName'],$data['UserNickName'],$data['UserPass']);
            $user->setId($data['UserID']);
            $user->setUserRoleID($data['UserRoleID']);
            $user->setUserNickName($data['UserNickName']);
            $user->setUserPass($data['UserPass']);
            $user->setUserEstReg($data['UserEstReg']);
            $user->setUserFecAct($data['UserFecAct']);
            return $user;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getAll(){
        $items = [];
        try{
            $db = new Database();
            $query = $db->connect()->query('SELECT * FROM User ORDER BY UserFecAct DESC');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new User($p['UserRoleID'],$p['UserName'],$p['UserNickName'],$p['UserPass']);
                $item->setId($p['AccID']);
                $item->setUserRoleID($p['UserRoleID']);
                $item->setUserName($p['UserName']);
                $item->setUserNickName($p['UserNickName']);
                $item->setUserPass($p['UserPass']);
                $item->setUserEstReg($p['UserEstReg']);
                $item->setUserFecAct($p['UserFecAct']);
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
    public function getUserEstReg():int{
        return $this->UserEstReg;
    }
    public function setUserEstReg(int $value){
        $this->UserEstReg = $value;
    }
    public function getUserFecAct():string{
        return $this->UserFecAct;
    }
    public function setUserFecAct(string $value){
        $this->UserFecAct = $value;
    }
    public function toArray():array{
        $arr = array("id"=>$this->id,"name"=>$this->UserName,"roleid"=>$this->UserRoleID,"nickname"=>$this->UserNickName,"password"=>$this->UserPass,"state"=>$this->UserEstReg,"UpdateDate"=>$this->UserFecAct);
        return $arr;
    }
    public function getUserName(){
        return $this->UserName;
    }
    public function setUserName($value){
        $this->UserName = $value;
    }
    public function getUserRoleID(){
        return $this->UserRoleID;
    }
    public function setUserRoleID($value){
        $this->UserRoleID = $value;
    }
    public function getUserNickName(){
        return $this->UserNickName;
    }
    public function setUserNickName($value){
        $this->UserNickName = $value;
    }
    public function getUserPass(){
        return $this->UserPass;
    }
    public function setUserPass($value){
        $this->UserPass = $value;
    }
}