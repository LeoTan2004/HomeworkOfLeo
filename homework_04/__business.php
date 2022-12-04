<?php
require '___logic.php';
class msg{
    public $code;
    public $message;
    /**
     * @param $code
     * @param $message
     */
    public function __construct(int $code,String $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

}

class userInfomation{
    public $username;
    public $sex;
    public $age;

    /**
     * @param $username
     * @param $sex
     * @param $age
     */
    public function __construct($s)
    {
        if (!defined('AGE')){
            define('AGE',uInfo::$age);
        }
        if (!defined('SEX')){
            define('SEX',uInfo::$sex);
        }
        if (!defined('I_USERNAME')){
            define('I_USERNAME',uInfo::$username);
        }
        $this->username = $s[I_USERNAME];
        $this->sex = $s[SEX];
        $this->age = $s[AGE];
    }

}
class login{
    private $logic;

    /**
     * @param $logic
     */
    public function __construct()
    {
        $this->logic = new logic_udb();
    }

    public function sign_up(String $username,String $password="123456"){
        if (empty($username)){
            return new msg(-1,"username is empty");
        }
        $res =  $this->logic->searchUser($username);
        if (mysqli_fetch_assoc($res)==null){
            return new msg(-5,"exist already");
        }
        $this->logic->addUser($username,$password);
        $res =  $this->logic->searchUser($username);
        if (mysqli_fetch_assoc($res)!=null){
            return new msg(0,"successful!");
        };
        return new msg(-2,"fail");
    }

    public function sign_in(String $username,String $password){
        if (empty($username)){
            return new msg(-1,"username is empty");
        }
        if (empty($password)){
            return new msg(-1,"password is empty");
        }
        $res = $this->logic->searchUser($username);
        $res = mysqli_fetch_assoc($res);
        if (!defined('PASSWORD')){
            define('PASSWORD',udb::$password);
        }
        if ($res==null){
            return new msg(-4,"No found");
        }
        if (strcmp($password,$res[PASSWORD])==0){
            return new msg(0,"login successfully");
        }
        return new msg(-2,"password is not right!");
    }

    public function change_password(String $username,String $password_former,String $password_change){
        if (empty($username)){
            return new msg(-1,"username is empty");
        }
        if (empty($password_former)||empty($password_change)){
            return new msg(-1,"password is empty");
        }
        echo array($username,$password_change,$password_former);
        $res = $this->logic->searchUser($username);
        $res = mysqli_fetch_assoc($res);
        if (!defined('PASSWORD')){
            define('PASSWORD',udb::$password);
        }
        if (strcmp($password_former,$res[PASSWORD])==0){
            $this->logic->updateUser($username,$password_change);
            if ($this->sign_in($username,$password_change)->code==0){
                return new msg(0,"changed successfally");
            }else{
                return new msg(-2,"failed to change");
            }
            return new msg(0,"login successfully");
        }
        return new msg(-2,"password is not right!");
    }

    public function sign_out(String $username,String $password){
        if (empty($username)){
            return new msg(-1,"username is empty");
        }
        if (empty($password)){
            return new msg(-1,"password is empty");
        }
        $res = $this->logic->searchUser($username);
        $res = mysqli_fetch_assoc($res);
        if (!defined('PASSWORD')){
            define('PASSWORD',udb::$password);
        }
        if (strcmp($password,$res[PASSWORD])==0){
            $this->logic->deleteUser($username);
            $res =  $this->logic->searchUser($username);
            if (mysqli_fetch_assoc($res)==null){
                return new msg(0,"delete successful!");
            }else{
                return new msg(-3,"delete failed");
            }
        }
        return new msg(-2,"password is not right!");
    }
}

class doInfo{
    private $Info;
    public function __construct()
    {
        $this->Info = new logic_uInfo();
    }
    public function getInfo(String $username){
        $res = $this->Info->searchInfo($username);
        $res = mysqli_fetch_assoc($res);
        if ($res==null){
            return new msg(-4,"No found");
        }
        return new userInfomation($res);
    }
    public function updateInfo(String $username,int $age=-1,String $sex =""){
        $res = $this->getInfo($username);
        $res = mysqli_fetch_assoc($res);
        if ($res==null){
            return new msg(-4,"No found");
        }
        if (!defined('AGE')){
            define('AGE',uInfo::$age);
        }
        if (!defined('SEX')){
            define('SEX',uInfo::$sex);
        }
        if (!defined('I_USERNAME')){
            define('I_USERNAME',uInfo::$username);
        }
        if ($age==-1){
            $age=$res[AGE];
        }
        if ($sex==""){
            $sex=$res[SEX];
        }
        $this->Info->updateInfo($username,$age,$sex);
        $res = mysqli_fetch_assoc($this->getInfo($username));
        if ($res[AGE]==$age&&strcmp($res[SEX],$sex)==0){
            return new msg(0,"changed successfully");
        }else{
            return new msg(-2,"changed failed");
        }
    }

    public function addInfo(String $username,String $sex="UNKNOW",int $age=0)
    {
        if (empty($username)){
            return new msg(-1,"empty username");
        }
        $res =  $this->Info->searchInfo($username);
        if (mysqli_fetch_assoc($res)!=null){
            return new msg(-5,"exist already");
        }
        $this->Info->addInfo($username,$sex,$age);
        $res =  $this->Info->searchInfo($username);
        if (mysqli_fetch_assoc($res)!=null){
            return new msg(0,"successfully");
        }
    }


    public function deleteInfo(String $username)
    {
        if (empty($username)){
            return new msg(-1,"empty username");
        }
        $res =  $this->Info->searchInfo($username);
        if (mysqli_fetch_assoc($res)==null){
            return new msg(-4,"No found");
        }
        $this->Info->deleteInfo($username);
        if (mysqli_fetch_assoc($res)==null){
            return new msg(0,"delete already");
        }
    }


}