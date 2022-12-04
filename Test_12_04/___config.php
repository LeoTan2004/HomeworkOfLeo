<?php
const  host = "localhost";
const  username = "root";
const  passsword = "root";
const  datebase = "user";
const  port = 3306;
class udb{
static  $id = "id";
static $username = "username";
static $password = "password";
static $tablename = "users";
}
class uInfo{
static  $tablename = "userInfo";
static  $id = "id";
static  $sex = "sex";
static  $nickname = "nickname";
static  $phone_num = "phone_num";
static  $qq = "qq";
static  $college = "college";
static  $profession = "profession";
}
session_start();
?>