<?php
namespace User\Backend\lib;
class View{

    function __construct(){

    }

    function render($nombre, $data = []){
        $this->d = $data;
        require 'src/components/' . $nombre . '.php';
    }
    
    
}

?>