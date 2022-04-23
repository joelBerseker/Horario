<?php

namespace User\Backend\lib;

use PDO;
use PDOException;

use User\Backend\config\Constants;

class Database{
    private string $host;
    private string $db;
    private string $user;
    private string $password;
    private string $charset;

    public function __construct(){
        $this->host = Constants::$HOST;
        $this->db = Constants::$DB;
        $this->user = Constants::$USER;
        $this->password = Constants::$PASSWORD;
        $this->charset = Constants::$CHARSET;
    }

    function connect(){
        try{
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $pdo = new PDO($connection, $this->user, $this->password, $options);
            return $pdo;
        }catch(PDOException $e)
        {
            print_r('Error connection: ' . $e->getMessage());
        }
    }

}

?>