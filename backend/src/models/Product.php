<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class Product extends Model
{

    private string $id;
    private int $ProEstReg;
    private $ProFecAct;
    private string $ProImg;

    public function __construct(
        private string $ProName,
        private string $ProDes,
        private int $ProTypeProID,
        private int $ProPre
    ) {
        parent::__construct();
        $this->ProImg = '';
        $this->ProEstReg = 0;
        $this->ProFecAct = '';
        $this->ProProm = 0;
    }

    public function save()
    {
        try {

            $query = $this->prepare('INSERT INTO Product (ProName, ProDes, ProTypeProID, ProImg, ProPre, ProProm) VALUES(:ProName, :ProDes, :ProTypeProID, :ProImg, :ProPre, :ProProm)');
            $query->execute([
                'ProName'  => $this->ProName,
                'ProDes'  => $this->ProDes,
                'ProTypeProID'  => $this->ProTypeProID,
                'ProImg'  => $this->ProImg,
                'ProPre'  => $this->ProPre,
                'ProProm'  => $this->ProProm,
            ]);
            return true;
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }
    public function update()
    {
        try {
            $query = $this->prepare('UPDATE product SET 
                            ProName         =:ProName,
                            ProDes          =:ProDes,
                            ProTypeProID    =:ProTypeProID,
                            ProImg          =:ProImg,
                            ProPre          =:ProPre,
                            ProProm         =:ProProm,
                            ProEstReg       =:ProEstReg
                            WHERE ProID     =:ProID');
            return $query->execute([
                'ProName'  => $this->ProName,
                'ProDes'  => $this->ProDes,
                'ProTypeProID'  => $this->ProTypeProID,
                'ProImg'  => $this->ProImg,
                'ProPre'  => $this->ProPre,
                'ProProm'  => $this->ProProm,
                'ProEstReg' => $this->ProEstReg,
                'ProID' => $this->id,
            ]);
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }


    public static function get($ProName)
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM Product WHERE ProName = :ProName');
            $query->execute(['ProName' => $ProName]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            error_log($data['ProName']);
            error_log($data['ProDes']);
            error_log($data['ProTypeProID']);
            error_log($data['ProPre']);
            error_log($data['ProProm']);
            $Product = new Product($data['ProName'], $data['ProDes'], $data['ProTypeProID'], $data['ProPre']);
            $Product->setId($data['ProID']);
            $Product->setProImg($data['ProImg']);
            return $Product;
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function delete($ProID)
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare('DELETE FROM Product WHERE ProID = :ProID');
            if ($query->execute(['ProID' => $ProID])) {
                return true;
            } else
                return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function getById($ProID)
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM product WHERE ProID = :ProID');
            $query->execute(['ProID' => $ProID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $prod = new Product($data['ProName'], $data['ProDes'], $data['ProTypeProID'], $data['ProPre']);
            $prod->setId($data['ProID']);
            $prod->setProImg($data['ProImg']);
            $prod->setProImg($data['ProProm']);
            $prod->setProEstReg($data['ProEstReg']);
            $prod->setProFecAct($data['ProFecAct']);
            return $prod->toArray();
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function getByIds($ProID)
    {
        try {
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM product WHERE ProID = :ProID');
            $query->execute(['ProID' => $ProID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $prod = new Product($data['ProName'], $data['ProDes'], $data['ProTypeProID'], $data['ProPre']);
            $prod->setId($data['ProID']);
            $prod->setProImg($data['ProImg']);
            $prod->setProImg($data['ProProm']);
            $prod->setProEstReg($data['ProEstReg']);
            $prod->setProFecAct($data['ProFecAct']);
            return $prod;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAll()
    {
        $items = [];
        try {
            $db = new Database();
            $query = $db->connect()->query('SELECT * FROM product ORDER BY ProFecAct DESC');
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new Product($p['ProName'], $p['ProDes'], $p['ProTypeProID'], $p['ProPre']);
                $item->setId($p['ProID']);
                $item->setProImg($p['ProImg']);
                $item->setProProm($p['ProProm']);
                $item->setProEstReg($p['ProEstReg']);
                $item->setProFecAct($p['ProFecAct']);

                array_push($items, $item->toArray());
            }
            return $items;
        } catch (PDOException $e) {
            echo "error";
            echo $e;
        }
    }
    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $value)
    {
        $this->id = $value;
    }
    public function getProEstReg(): int
    {
        return $this->ProEstReg;
    }
    public function setProEstReg(int $value)
    {
        $this->ProEstReg = $value;
    }
    public function getProFecAct(): string
    {
        return $this->ProFecAct;
    }
    public function setProFecAct(string $value)
    {
        $this->ProFecAct = $value;
    }
    public function toArray(): array
    {
        $arr = array("id" => $this->id, "name" => $this->ProName, "image" => $this->ProImg, "description" => $this->ProDes, "typeproid" => $this->ProTypeProID, "price" => $this->ProPre, "promotion" => $this->ProProm, "state" => $this->ProEstReg, "UpdateDate" => $this->ProFecAct);
        return $arr;
    }
    public function getProName()
    {
        return $this->ProName;
    }
    public function setProName($value)
    {
        $this->ProName = $value;
    }
    public function getProDes()
    {
        return $this->ProDes;
    }
    public function setProDes($value)
    {
        $this->ProDes = $value;
    }

    public function setProImg($value)
    {
        $this->ProImg = $value;
    }

    public function getProImg()
    {
        return $this->ProImg;
    }
    public function setProTypeProID($value)
    {
        $this->ProTypeProID = $value;
    }

    public function getProTypeProID()
    {
        return $this->ProTypeProID;
    }
    public function setProPre($value)
    {
        $this->ProPre = $value;
    }

    public function getProPre()
    {
        return $this->ProPre;
    }
    public function setProProm($value)
    {
        $this->ProProm = $value;
    }

    public function getProProm()
    {
        return $this->ProProm;
    }
}
