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
    private $TicHeadPorDesc;
    private string $TicHeadRUC;
    
    public function __construct(
        private int $TicHeadUserID,
        private int $TicHeadTabID,
        private $TicHeadFec,
        private string $TicHeadLocName
    )
    {
        parent::__construct();
        $this->TicHeadEstReg=0;
        $this->TicHeadFecAct='';
        $this->TicHeadPorDesc=0;
        $this->TicHeadRUC='';
    }

    public function save(){
        try{
            $query = $this->prepare('INSERT INTO Ticketheader (TicHeadUserID, TicHeadFec, TicHeadLocName, TicHeadTabID) VALUES(:TicHeadUserID, :TicHeadFec, :TicHeadLocName, :TicHeadTabID)');
            $query->execute([
                'TicHeadUserID'  => $this->TicHeadUserID, 
                'TicHeadFec'  => $this->TicHeadFec,
                'TicHeadLocName'  => $this->TicHeadLocName,
                'TicHeadTabID'  => $this->TicHeadTabID, 
                ]);
            //echo $this->lastInsertId();
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }
    public function update(){

        try{
            $query = $this->prepare('UPDATE ticketheader SET TicHeadUserID =:TicHeadUserID, TicHeadFec =:TicHeadFec, TicHeadRUC =:TicHeadRUC, TicHeadLocName =:TicHeadLocName, TicHeadPorDesc =:TicHeadPorDesc, TicHeadEstReg =:TicHeadEstReg, TicHeadTabID =:TicHeadTabID WHERE TicHeadID =:TicHeadID');
            
            return $query->execute([
                'TicHeadUserID'  => $this->TicHeadUserID,             
                'TicHeadFec'  => $this->TicHeadFec,
                'TicHeadRUC'  => $this->TicHeadRUC,  
                'TicHeadLocName'  => $this->TicHeadLocName,
                'TicHeadPorDesc'  => $this->TicHeadPorDesc,
                'TicHeadEstReg' =>$this->TicHeadEstReg,
                'TicHeadTabID'  => $this->TicHeadTabID, 
                'TicHeadID'=> $this->id,
                ]);
        }catch(PDOException $e){
            
            echo $e;
            echo "error de putos";
            return false;
        }
    } 
    public static function delete($TicHeadID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('DELETE FROM Ticketheader WHERE TicHeadID = :TicHeadID');
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
            $query = $db->connect()->prepare('SELECT * FROM Ticketheader WHERE TicHeadID = :TicHeadID');
            $query->execute([ 'TicHeadID' => $TicHeadID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $TicketHeader = new TicketHeader($data['TicHeadUserID'],$data['TicHeadTabID'], $data['TicHeadFec'], $data['TicHeadLocName']);
            $TicketHeader->setId($data['TicHeadID']);
            $TicketHeader->setTicHeadRUC($data['TicHeadRUC']);
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
            $query = $db->connect()->prepare('SELECT * FROM Ticketheader WHERE TicHeadID = :TicHeadID');
            $query->execute([ 'TicHeadID' => $TicHeadID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $TicketHeader = new TicketHeader($data['TicHeadUserID'],$data['TicHeadTabID'], $data['TicHeadFec'], $data['TicHeadLocName']);
            $TicketHeader->setId($data['TicHeadID']);
            $TicketHeader->setTicHeadRUC($data['TicHeadRUC']);
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
            $query = $db->connect()->query('SELECT * FROM Ticketheader ORDER BY TicHeadFecAct DESC');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new TicketHeader($p['TicHeadUserID'],$p['TicHeadTabID'], $p['TicHeadFec'], $p['TicHeadLocName']);
                $item->setId($p['TicHeadID']);
                $item->setTicHeadRUC($p['TicHeadRUC']);
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
        $arr = array("id"=>$this->id,"userid"=>$this->TicHeadUserID,"tabid"=>$this->TicHeadTabID,"date"=>$this->TicHeadFec,"RUC"=>$this->TicHeadRUC,"localname"=>$this->TicHeadLocName,"percdesc"=>$this->TicHeadPorDesc,"state"=>$this->TicHeadEstReg,"UpdateDate"=>$this->TicHeadFecAct);
        return $arr;
    }
    public function getTicHeadUserID(){
        return $this->TicHeadUserID;
    }
    public function setTicHeadUserID($value){
        $this->TicHeadUserID = $value;
    }
    public function getTicHeadTabID(){
        return $this->TicHeadTabID;
    }
    public function setTicHeadTabID($value){
        $this->TicHeadTabID = $value;
    }
    public function getTicHeadFec():string{
        return $this->TicHeadFec;
    }
    public function setTicHeadFec(string $value){
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