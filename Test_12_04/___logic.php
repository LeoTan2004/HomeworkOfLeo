<?php
require '___config.php';


class logic_udb{
    private $sqlConn;
    private $add;
    private $delete;
    private $select_by_id;
    private $select_by_username;
    private $update;
    public function __construct()
    {
        $sqlConn = new mysqli(host,username,passsword,datebase,port);
        $this->sqlConn = $sqlConn;
        $tablename = udb::$tablename;
        $username = udb::$username;
        $password = udb::$password;
        $id = udb::$id;
        $add = $sqlConn->prepare("INSERT INTO $tablename ($username,$password) VALUES(?,?)");
//        $add->bind_param("ss",$this->username,$this->pwd);
        $this->add = $add;

        $delete = $sqlConn->prepare("DELETE FROM $tablename WHERE $id = ?");
//        $delete->bind_param("s",$this->username);
        $this->delete = $delete;

        $select_username = $sqlConn->prepare("SELECT * FROM $tablename WHERE $username = ?");
//        $select->bind_param("s",$this->username);
        $this->select_by_username = $select_username;

        $select_id = $sqlConn->prepare("SELECT * FROM $tablename WHERE $id = ?");
//        $select->bind_param("s",$this->username);
        $this->select_by_id = $select_id;

        $update = $sqlConn->prepare("UPDATE $tablename SET $password = ? WHERE $id = ?");
//        $update->bind_param("ss",$this->pwd,$this->username);
        $this->update = $update;
    }

    public function addUser($username,$password){
        $this->add->bind_param("ss",$username,$password);
        $this->add->execute();
    }

    public function deleteUser($id){
        $this->delete->bind_param("i",$id);
        $this->delete->execute();
    }

    public function searchUser_by_username($username){
        $this->select_by_username->bind_param("s",$username);
        $this->select_by_username->execute();
        return $this->select_by_username->get_result();
    }

    public function searchUser_by_id($id){
        $this->select_by_id->bind_param("i",$id);
        $this->select_by_id->execute();
        return $this->select_by_id->get_result();
    }

    public function updateUser($id,$password){
        $this->update->bind_param("si",$password,$id);
        $this->update->execute();
    }

    public function getId($username)
    {
        $res = $this->select_by_username($username);
        if (!defined("id")){
            define("ID",udb::$id);
        }
        return mysqli_fetch_assoc($res)[ID];
    }


}
//
class logic_uInfo{
    private $sqlConn;
    private $add;
    private $delete;
    private $select;
    private $update;

    public function __construct()
    {
        $sqlConn = new mysqli(host,username,passsword,datebase,port);
        $this->sqlConn = $sqlConn;
        $tablename = uInfo::$tablename;
        $id = uInfo::$id;
        $sex = uInfo::$sex;
        $nickname = uInfo::$nickname;
        $phone_num = uInfo::$phone_num;
        $qq = uInfo::$qq;
        $college = uInfo::$college;
        $profession = uInfo::$profession;

        $add = $sqlConn->prepare("INSERT INTO $tablename ($id,$nickname,$sex,$phone_num,$qq,$college,$profession) VALUE(?,?,?,?,?,?,?)");
        $this->add = $add;

        $delete = $sqlConn->prepare("DELETE FROM $tablename WHERE $id = ?");
        $this->delete = $delete;

        $select = $sqlConn->prepare("SELECT * FROM $tablename WHERE $id = ? ");
        $this->select = $select;

        $update = $sqlConn->prepare("UPDATE $tablename SET $nickname = ? WHERE $id = ?");
        $this->update = $update;
    }
    public function addInfo($id,$nickname,$sex,$phone_num,$qq,$college,$profession){
        /**
         * $id,$nickname,$sex,$phone_num,$qq,$college,$profession
         *
         */
        $this->add->bind_param("issiiss",$id,$nickname,$sex,$phone_num,$qq,$college,$profession);
        $this->add->execute();
    }

    public function deleteInfo($id){
        $this->delete->bind_param("i",$id);
        $this->delete->execute();
    }

    public function searchInfo($id){
        $this->select->bind_param("i",$id);
        $this->select->execute();
        return $this->select->get_result();
    }

    public function updateInfo($id,$nickname){
        $this->update->bind_param("si",$nickname,$id);
        $this->update->execute();
    }
}
