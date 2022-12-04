<?php
$info = new doInfo();
$id = $_POST['id']??"";
$id = (int)$id;
$sex = $_POST['sex']??"";
$nickname =$_POST['nickname']??"";
$phone_num = $id = $_POST['phone_num']??"";
$phone_num = (int)$phone_num;
$qq =  $_POST['qq']??"";
$qq = (int)($qq);
$college = $_POST["college"]??"";
$profession = $_POST["profession"]??"";
echo json_encode($info->addInfo($id,$nickname,$sex,$phone_num,$qq,$college,$profession));