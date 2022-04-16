<?php
header ("Access-Control-Allow-Origin: *");

$arr = array("response"=>$this->d['response'],"message"=>$this->d['message'],"data"=>array("user"=>$this->d['user'],"permises"=>$this->d['permises']));
echo json_encode($arr);
?>