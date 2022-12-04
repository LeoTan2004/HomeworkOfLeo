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
    public  $sex;
    public  $nickname;
    public  $phone_num;
    public  $qq;
    public  $college;
    public  $profession;

    public function __construct($s)
    {
        if (!defined('NICKNAME')){
            define('NICKNAME',uInfo::$nickname);
        }
        if (!defined('SEX')){
            define('SEX',uInfo::$sex);
        }
        if (!defined('PHONE_NUM')){
            define('PHONE_NUM',uInfo::$phone_num);
        }
        if (!defined('QQ')){
            define('QQ',uInfo::$qq);
        }
        if (!defined('COLLEGE')){
            define('COLLEGE',uInfo::$college);
        }
        if (!defined('PROFESSION')){
            define('PROFESSION',uInfo::$profession);
        }
        $this->nickname=$s[NICKNAME];
        $this->profession = $s[PROFESSION];
        $this->college = $s[COLLEGE];
        $this->qq = $s[QQ];
        $this->phone_num  = $s[PHONE_NUM];
        $this->sex = $s[SEX];
    }

}
class login{
    private $logic;

    public function __construct()
    {
        $this->logic = new logic_udb();
    }

    public function sign_up(String $username,String $password="123456"){
        if (empty($username)){
            return new msg(-1,"username is empty");
        }
        $res =  $this->logic->searchUser_by_username($username);
        if (mysqli_fetch_assoc($res)==null){
            return new msg(-5,"exist already");
        }
        $this->logic->addUser($username,$password);
        if (!defined("id")){
            define("ID",udb::$id);
        }
        $res =  $this->logic->searchUser_by_username($username);
        if (mysqli_fetch_assoc($res)!=null){
            mysqli_fetch_assoc($res)[ID];
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
        $res = $this->logic->searchUser_by_username($username);
        $res = mysqli_fetch_assoc($res);
        if (!defined('PASSWORD')){
            define('PASSWORD',udb::$password);
        }
        if ($res==null){
            return new msg(-4,"No found");
        }
        if (strcmp($password,$res[PASSWORD])==0){
            if (!defined("id")){
                define("ID",udb::$id);
            }
            $id = $res[ID];
            return new msg(0,"login successfully,id = $id");
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
//        echo array($username,$password_change,$password_former);
        $res = $this->logic->searchUser_by_username($username);
        $res = mysqli_fetch_assoc($res);
        if (!defined('PASSWORD')){
            define('PASSWORD',udb::$password);
        }
        if (strcmp($password_former,$res[PASSWORD])==0){
            $id = $this->logic->getId($username);
            $this->logic->updateUser($id,$password_change);
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
        $res = $this->logic->searchUser_by_username($username);
        $res = mysqli_fetch_assoc($res);
        if (!defined('PASSWORD')){
            define('PASSWORD',udb::$password);
        }
        if (strcmp($password,$res[PASSWORD])==0){
            $this->logic->deleteUser($username);
            $res =  $this->logic->searchUser_by_username($username);
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
    public function getInfo(int $id){
        $res = $this->Info->searchInfo($id);
        $res = mysqli_fetch_assoc($res);
        if ($res==null){
            return new msg(-4,"No found");
        }
        return new userInfomation($res);
    }
    public function updateInfo(int $id,string $nickname){
        $res = $this->getInfo($id);
        $res = mysqli_fetch_assoc($res);
        if ($res==null){
            return new msg(-4,"No found");
        }

        if (!defined('NICKNAME')){
            define('NICKNAME',uInfo::$nickname);
        }

        if ($nickname==""){
            $nickname=$res[NICKNAME];
        }
        $this->Info->updateInfo($id,$nickname);
        $res = mysqli_fetch_assoc($this->getInfo($id));
        if (strcmp($res[NICKNAME],$nickname)==0){
            return new msg(0,"changed successfully");
        }else{
            return new msg(-2,"changed failed");
        }
    }

    public function addInfo($id,$nickname,$sex,$phone_num,$qq,$college,$profession)
    {
        if ($id = null){
            return new msg(-1,"empty id");
        }
        $res =  $this->Info->searchInfo($id);
        if (mysqli_fetch_assoc($res)!=null){
            return new msg(-5,"exist already");
        }
        $this->Info->addInfo($id,$nickname,$sex,$phone_num,$qq,$college,$profession);
        $res =  $this->Info->searchInfo($id);
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