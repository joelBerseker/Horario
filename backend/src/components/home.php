<?php
header ("Access-Control-Allow-Origin: *");
echo  $this->d['user'];
$arr = array("respuesta"=>1,"envio"=>"tablero","c"=>3,"d"=>4,"e"=>5);
echo json_encode($arr);
?>