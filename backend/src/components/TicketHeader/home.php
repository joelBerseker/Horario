<?php
header ("Access-Control-Allow-Origin: *");
if($this->d['op']==0){ // ALL
    $arr = array("response"=>$this->d['response'],"message"=>$this->d['message'],"data"=>array("ticketheaders"=>$this->d['ticketheaders']));
    echo json_encode($arr);
}else if($this->d['op']==1){ // ADDD
    $arr = array("response"=>$this->d['response'],"message"=>$this->d['message']);
    echo json_encode($arr);
}else if($this->d['op']==2){ // VIEW
    $arr = array("response"=>$this->d['response'],"message"=>$this->d['message'],"data"=>array("ticketheader"=>$this->d['ticketheader']));
    echo json_encode($arr);
}else if($this->d['op']==3){ // EDIT
    $arr = array("response"=>$this->d['response'],"message"=>$this->d['message'],"data"=>array("ticketheader"=>$this->d['ticketheader']));
    echo json_encode($arr);
}else if($this->d['op']==4){ // DELETE
    $arr = array("response"=>$this->d['response'],"message"=>$this->d['message']);
    echo json_encode($arr);
}
?>