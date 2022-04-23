<?php
header ("Access-Control-Allow-Origin: *");
if($this->d['op']<=1){ // login
    $arr = array("response"=>$this->d['response'],"message"=>$this->d['message'],"data"=>array("user"=>$this->d['user'],"permises"=>$this->d['permises']));
    echo json_encode($arr);
}else if($this->d['op']==2){//logout
    $arr = array("response"=>$this->d['response'],"message"=>$this->d['message']);
    echo json_encode($arr);
}else if($this->d['op']==0){//logout
    $arr = array("response"=>$this->d['response'],"message"=>$this->d['message'],"data"=>array("user"=>$this->d['user'],"permises"=>$this->d['permises']));
    echo json_encode($arr);
}
?>