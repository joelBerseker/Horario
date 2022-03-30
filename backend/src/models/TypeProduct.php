<?php

namespace User\Backend\models;

use User\Backend\lib\Database;
use User\Backend\lib\Model;

use PDO;
use PDOException;

class TypeProduct extends Model{

    private string $id;
    private array $posts;
    private string $TypeProImg;

    public function __construct(
        private string $TypeProName,
        private string $TypeProDes
    )
    {
        parent::__construct();
        $this->posts = [];
        $this->TypeProImg = '';
    }

    public static function exists($TypeProName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT TypeProName FROM typeproduct WHERE TypeProName = :TypeProName');
            $query->execute( ['TypeProName' => $TypeProName]);
            
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

   

    public function save(){
        try{
            
            $query = $this->prepare('INSERT INTO typeproduct (TypeProName, TypeProDes, TypeProImg) VALUES(:TypeProName, :TypeProDes, :TypeProImg)');
            $query->execute([
                'TypeProName'  => $this->TypeProName, 
                'TypeProDes'  => $this->TypeProDes,
                'TypeProImg'  => $this->TypeProImg,
                ]);
            return true;
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    } 

    public static function get($TypeProName){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM typeproduct WHERE TypeProName = :TypeProName');
            $query->execute([ 'TypeProName' => $TypeProName]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            error_log($data['TypeProName']);
            error_log($data['TypeProDes']);
            $typeProduct = new TypeProduct($data['TypeProName'], $data['TypeProDes']);
            $typeProduct->setId($data['TypeProID']);
            $typeProduct->setTypeProImg($data['TypeProImg']);
            return $typeProduct;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getById($TypeProID){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM typeproduct WHERE TypeProID = :TypeProID');
            $query->execute([ 'TypeProID' => $TypeProID]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $typeProduct = new TypeProduct($data['TypeProName'], $data['TypeProDes']);
            $typeProduct->setId($data['TypeProID']);
            $typeProduct->setTypeProImg($data['TypeProImg']);
            return $typeProduct;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getAll(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM typeproduct');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new TypeProduct($p['TypeProName'], $p['TypeProDes']);
                $item->setId($p['TypeProID']);
                $item->setTypeProImg($p['TypeProImg']);

                array_push($items, $item);
            }
            return $items;


        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getId():string{
        return $this->id;
    }

    public function setId(string $value){
        $this->id = $value;
    }

    public function getTypeProName(){
        return $this->TypeProName;
    }

    public function getPosts(){
        return $this->posts;
    }

    public function setPosts($value){
        $this->posts = $value;
    }

    public function setTypeProImg($value){
        $this->TypeProImg = $value;
    }

    public function getTypeProImg(){
        return $this->TypeProImg;
    }

    /*public function publish(Post $post){
        $res = $post->publish($this->id);
        array_push($this->posts, $res);
    }

    public function fetchPosts(){
        $this->posts = PostImage::getAll($this->getId());
    }

    /* 
    public function getTypeProName():string{
        return $this->TypeProName;
    } */

    /*  */

   /*  public function getPosts():array{
        return $this->posts;
    }
    public function getFollowers():array{
        return $this->followers;
    }
    public function showPosts(){
        foreach($this->posts as $post){
            var_dump($post->toString());
        }
    }
    private function hasFollower(User $typeProduct){
        $found = array_filter(
            $this->followers, 
            fn (User $follower) => $follower->id === $typeProduct->id
        );
        return count($found) === 1;
    }
    public function addFollower(User $typeProduct){
        if(!$this->hasFollower($typeProduct)){
            if($this->id === $typeProduct->id){
                print_r("No te puedes agregar a ti mismo como follower \n");
            }else{
                array_push($this->followers, $typeProduct);
            }
        }else{
            print_r("El usuario $typeProduct->TypeProName ya es un follower \n");
        }
    }
    public static function showTypeProImg(User $typeProduct){
        $TypeProImg = "Nombre: $typeProduct->TypeProName \n";
        $TypeProImg .= "Followers: " . count($typeProduct->followers) . "\n";
        $TypeProImg .= "Posts: " . count($typeProduct->posts) . "\n\n";
        return $TypeProImg;
    } */


    

}