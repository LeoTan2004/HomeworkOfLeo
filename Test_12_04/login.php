<?php

$username = $_POST['username']??"";
$password = $_POST['pwd']??"";
$log = new login();
$info = new doInfo();
$s =  $log->sign_in($username,$password);
echo json_encode($s);
if ($s->code==0){
    echo json_encode($info->getInfo($username));
}