<?php
$info = new doInfo();
$id = $_POST['id']??"";
$id = (int)$id;

$nickname =$_POST['nickname']??"";

echo json_encode($info->updateInfo($id,$nickname));