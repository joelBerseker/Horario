<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class TicketHeader extends Model{

    private string $id;
    private int $TicHeadEstReg;
    private $TicHeadFecAct;
    
    public function __construct(
        private int $TicHeadUserID,
        private $TicHeadFec,
        private string $TicHeadRUC,
        private string $TicHeadLocName,
        private string $TicHeadPorDesc
    )
    {
        parent::__construct();
        $this->TicHeadEstReg=0;
        $this->TicHeadFecAct='';
    }

    public function save(){
        try{
            
            $query = $this->prepare('INSERT INTO TicketHeader (TicHeadUserID, TicHeadFec, TicHeadRUC, TicHeadLocName, TicHeadPorDesc) VALUES(:TicHeadUserID, :TicHeadFec, :TicHeadRUC, :TicHeadLocName, :TicHeadPorDesc)');
            $query->execute([
                'TicHeadUserID'  => $this->TicHeadUserID, 
                'TicHeadFec'  => $this->TicHeadFec,
                'TicHeadRUC'  => $this->TicHeadRUC,
                'TicHeadLocName'  => $this->TicHeadLocName,
                'TicHeadPorDesc'  => $this->TicHeadPorDesc,
                ]);
            return true;
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    }
    public function update(){
        try{
            $query = $this->prepare('UPDATE TicketHeader SET TicHeadUserID =:TicHeadUserID, TicHeadFec=:TicHeadFec, TicHeadRUC=: TicHeadRUC, TicHeadLocName= :TicHeadLocName, TicHeadPorDesc= :TicHeadPorDesc, TicHeadEstReg=:TicHeadEstReg WHERE TicHeadID=:TicHeadID');
            return $query->execute([
                'TicHeadUserID'  => $this->TicHeadUserID, 
                'TicHeadFec'  => $this->TicHeadFec,
                'TicHeadRUC'  => $this->TicHeadRUC,
                'TicHeadLocName'  => $this->TicHeadLocName,
                'TicHeadPorDesc'  => $this->TicHeadPorDesc,
                'TicHeadEstReg' =>$this->TicHeadEstReg,
                'TicHeadID'=> $this->id,
                ]);
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    } 
    public static function delete($TicHeadID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('DELETE FROM TicketHeader WHERE TicHeadID = :TicHeadID');
            if ($query->execute([ 'TicHeadID' => $TicHeadID])){
                return true;
            }
            else
                return false;
        }catch(PDOException $e){
            return false;
        } 
    }
    public static function getById($TicHeadID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM TicketHeader WHERE TicHeadID = :TicHeadID');
            $query->execute([ 'TicHeadID' => $TicHeadID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $TicketHeader = new TicketHeader($data['TicHeadUserID'], $data['TicHeadFec'], $data['TicHeadRUC'], $data['TicHeadLocName'], $data['TicHeadPorDesc']);
            $TicketHeader->setId($data['TicHeadID']);
            $TicketHeader->setTicHeadUserID($data['TicHeadUserID']);
            $TicketHeader->setTicHeadFec($data['TicHeadFec']);
            $TicketHeader->setTicHeadRUC($data['TicHeadRUC']);
            $TicketHeader->setTicHeadLocName($data['TicHeadLocName']);
            $TicketHeader->setTicHeadPorDesc($data['TicHeadPorDesc']);
            $TicketHeader->setTicHeadEstReg($data['TicHeadEstReg']);
            $TicketHeader->setTicHeadFecAct($data['TicHeadFecAct']);
            return $TicketHeader->toArray();
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getByIds($TicHeadID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM TicketHeader WHERE TicHeadID = :TicHeadID');
            $query->execute([ 'TicHeadID' => $TicHeadID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $TicketHeader = new TicketHeader($data['TicHeadUserID'], $data['TicHeadFec'], $data['TicHeadRUC'], $data['TicHeadLocName'], $data['TicHeadPorDesc']);
            $TicketHeader->setId($data['TicHeadID']);
            $TicketHeader->setTicHeadUserID($data['TicHeadUserID']);
            $TicketHeader->setTicHeadFec($data['TicHeadFec']);
            $TicketHeader->setTicHeadRUC($data['TicHeadRUC']);
            $TicketHeader->setTicHeadLocName($data['TicHeadLocName']);
            $TicketHeader->setTicHeadPorDesc($data['TicHeadPorDesc']);
            $TicketHeader->setTicHeadEstReg($data['TicHeadEstReg']);
            $TicketHeader->setTicHeadFecAct($data['TicHeadFecAct']);
            return $TicketHeader;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getAll(){
        $items = [];
        try{
            $db = new Database();
            $query = $db->connect()->query('SELECT * FROM TicketHeader ORDER BY TicHeadFecAct DESC');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new TicketHeader($p['TicHeadUserID'], $p['TicHeadFec'], $p['TicHeadRUC'], $p['TicHeadLocName'], $p['TicHeadPorDesc']);
                $item->setId($p['TicHeadID']);
                $item->setTicHeadUserID($p['TicHeadUserID']);
                $item->setTicHead>Fec($p['TicHeadFec']);
                $item->setTicHeadRUC($p['TicHeadRUC']);
                $item->setTicHeadLocName($p['TicHeadLocName']);
                $item->setTicHeadPorDesc($p['TicHeadPorDesc']);
                $item->setTicHeadEstReg($p['TicHeadEstReg']);
                $item->setTicHeadFecAct($p['TicHeadFecAct']);
                
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
    public function getTicHeadEstReg():int{
        return $this->TicHeadEstReg;
    }
    public function setTicHeadEstReg(int $value){
        $this->TicHeadEstReg = $value;
    }
    public function getTicHeadFecAct():string{
        return $this->TicHeadFecAct;
    }
    public function setTicHeadFecAct(string $value){
        $this->TicHeadFecAct = $value;
    }
    public function toArray():array{
        $arr = array("id"=>$this->id,"userid"=>$this->TicHeadUserID,"date"=>$this->TicHeadFec,"RUC"=>$this->TicHeadRUC,"localname"=>$this->TicHeadLocName,"percdesc"=>$this->TicHeadPorDesc,"state"=>$this->TicHeadEstReg,"UpdateDate"=>$this->TicHeadFecAct);
        return $arr;
    }
    public function getTicHeadUserID(){
        return $this->TicHeadUserID;
    }
    public function setTicHeadUserID($value){
        $this->TicHeadUserID = $value;
    }
    public function getTicHeadFec(){
        return $this->TicHeadFec;
    }
    public function setTicHeadFec($value){
        $this->TicHeadFec = $value;
    }

    public function setTicHeadRUC($value){
        $this->TicHeadRUC = $value;
    }

    public function getTicHeadRUC(){
        return $this->TicHeadRUC;
    }
    public function setTicHeadLocName($value){
        $this->TicHeadLocName = $value;
    }

    public function getTicHeadLocName(){
        return $this->TicHeadLocName;
    }
    public function setTicHeadPorDesc($value){
        $this->TicHeadPorDesc = $value;
    }

    public function getTicHeadPorDesc(){
        return $this->TicHeadPorDesc;
    }
}