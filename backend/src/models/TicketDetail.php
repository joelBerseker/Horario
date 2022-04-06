<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class TicketDetail extends Model{

    private string $id;
    private int $TicDetEstReg;
    private $TicDetFecAct;
    
    public function __construct(
        private int $TicDetHeadID,
        private int $TicDetProID,
        private string $TicDetDes,
        private int $TicDetCant
    )
    {
        parent::__construct();
        $this->TicDetEstReg=0;
        $this->TicDetFecAct='';
    }

    public function save(){
        try{
            
            $query = $this->prepare('INSERT INTO TicketDetail (TicDetHeadID, TicDetDes, TicDetCant) VALUES(:TicDetHeadID, :TicDetDes, :TicDetCant)');
            $query->execute([
                'TicDetHeadID'  => $this->TicDetHeadID, 
                'TicDetDes'  => $this->TicDetDes,
                'TicDetCant'  => $this->TicDetCant,
                ]);
            return true;
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    }
    public function update(){
        try{
            $query = $this->prepare('UPDATE TicketDetail SET TicDetHeadID =:TicDetHeadID, TicDetDes=:TicDetDes, TicDetCant=: TicDetCant, TicDetEstReg=:TicDetEstReg WHERE TicDetID=:TicDetID');
            return $query->execute([
                'TicDetHeadID'  => $this->TicDetHeadID, 
                'TicDetDes'  => $this->TicDetDes,
                'TicDetCant'  => $this->TicDetCant,
                'TicDetEstReg' =>$this->TicDetEstReg,
                'TicDetID'=> $this->id,
                ]);
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    } 
    public static function delete($TicDetID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('DELETE FROM TicketDetail WHERE TicDetID = :TicDetID');
            if ($query->execute([ 'TicDetID' => $TicDetID])){
                return true;
            }
            else
                return false;
        }catch(PDOException $e){
            return false;
        } 
    }
    public static function getById($TicDetID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM TicketDetail WHERE TicDetID = :TicDetID');
            $query->execute([ 'TicDetID' => $TicDetID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $TicketDetail = new TicketDetail($data['TicDetHeadID'], $data['TicDetDes'], $data['TicDetCant']);
            $TicketDetail->setId($data['TicDetID']);
            $TicketDetail->setTicDetHeadID($data['TicDetHeadID']);
            $TicketDetail->setTicDetDes($data['TicDetDes']);
            $TicketDetail->setTicDetCant($data['TicDetCant']);
            $TicketDetail->setTicDetEstReg($data['TicDetEstReg']);
            $TicketDetail->setTicDetFecAct($data['TicDetFecAct']);
            return $TicketDetail->toArray();
        }catch(PDOException $e){
            return false;
        }
    }
    public static function getByIds($TicDetID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM TicketDetail WHERE TicDetID = :TicDetID');
            $query->execute([ 'TicDetID' => $TicDetID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $TicketDetail = new TicketDetail($data['TicDetHeadID'], $data['TicDetDes'], $data['TicDetCant']);
            $TicketDetail->setId($data['TicDetID']);
            $TicketDetail->setTicDetHeadID($data['TicDetHeadID']);
            $TicketDetail->setTicDetDes($data['TicDetDes']);
            $TicketDetail->setTicDetCant($data['TicDetCant']);
            $TicketDetail->setTicDetEstReg($data['TicDetEstReg']);
            $TicketDetail->setTicDetFecAct($data['TicDetFecAct']);
            return $TicketDetail;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getAll(){
        $items = [];
        try{
            $db = new Database();
            $query = $db->connect()->query('SELECT * FROM TicketDetail ORDER BY TicDetFecAct DESC');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new TicketDetail($p['TicDetHeadID'], $p['TicDetDes'], $p['TicDetCant']);
                $item->setId($p['TicDetID']);
                $item->setTicDetHeadID($p['TicDetHeadID']);
                $item->setTicDet>Fec($p['TicDetDes']);
                $item->setTicDetCant($p['TicDetCant']);
                $item->setTicDetEstReg($p['TicDetEstReg']);
                $item->setTicDetFecAct($p['TicDetFecAct']);
                
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
    public function getTicDetEstReg():int{
        return $this->TicDetEstReg;
    }
    public function setTicDetEstReg(int $value){
        $this->TicDetEstReg = $value;
    }
    public function getTicDetFecAct():string{
        return $this->TicDetFecAct;
    }
    public function setTicDetFecAct(string $value){
        $this->TicDetFecAct = $value;
    }
    public function toArray():array{
        $arr = array(
            "id"        =>  $this->id,
            "tichead"   =>  $this->TicDetTicHeadID,
            "proid"     =>  $this->TicHeadProID,
            "description"=> $this->TicDetDes,
            "quantity"  =>  $this->TicDetCant,
            "state"     =>  $this->TicHeadEstReg,
            "UpdateDate"=>  $this->TicHeadFecAct);
        return $arr;
    }
    public function getTicDetHeadID(){
        return $this->TicDetHeadID;
    }
    public function setTicDetHeadID($value){
        $this->TicDetHeadID = $value;
    }
    public function getTicDetDes(){
        return $this->TicDetDes;
    }
    public function setTicDetDes($value){
        $this->TicDetDes = $value;
    }

    public function setTicDetCant($value){
        $this->TicDetCant = $value;
    }

    public function getTicDetCant(){
        return $this->TicDetCant;
    }
}