<?php
require '___config.php';


class logic_udb{
    private $sqlConn;
    private $add;
    private $delete;
    private $select;
    private $update;
    public function __construct()
    {
        $sqlConn = new mysqli(host,username,passsword,datebase,port);
        $this->sqlConn = $sqlConn;
        $tablename = udb::$tablename;
        $username = udb::$username;
        $password = udb::$password;

        $add = $sqlConn->prepare("INSERT INTO $tablename ($username,$password) VALUES(?,?)");
//        $add->bind_param("ss",$this->username,$this->pwd);
        $this->add = $add;

        $delete = $sqlConn->prepare("DELETE FROM $tablename WHERE $username = ?");
//        $delete->bind_param("s",$this->username);
        $this->delete = $delete;

        $select = $sqlConn->prepare("SELECT * FROM $tablename WHERE $username = ?");
//        $select->bind_param("s",$this->username);
        $this->select = $select;

        $update = $sqlConn->prepare("UPDATE $tablename SET $password = ? WHERE $username = ?");
//        $update->bind_param("ss",$this->pwd,$this->username);
        $this->update = $update;
    }

    public function addUser($username,$password){
        $this->add->bind_param("ss",$username,$password);
        $this->add->execute();
    }

    public function deleteUser($username){
        $this->delete->bind_param("s",$username);
        $this->delete->execute();
    }

    public function searchUser($username){
//        $this->select->execute(array($username));
        $this->select->bind_param("s",$username);
        $this->select->execute();
        return $this->select->get_result();
    }

    public function updateUser($username,$password){
        $this->update->bind_param("ss",$password,$username);
        $this->update->execute();
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
        $username = uInfo::$username;
        $sex = uInfo::$sex;
        $age = uInfo::$age;

        $add = $sqlConn->prepare("INSERT INTO $tablename ($username,$sex,$age) VALUES(?,?,?)");
        $this->add = $add;

        $delete = $sqlConn->prepare("DELETE FROM $tablename WHERE $username = ?");
        $this->delete = $delete;

        $select = $sqlConn->prepare("SELECT * FROM $tablename WHERE $username = ? ");
        $this->select = $select;

        $update = $sqlConn->prepare("UPDATE $tablename SET $age = ?,$sex=? WHERE $username = ?");
        $this->update = $update;
    }
    public function addInfo($username,$sex,$age){
        $this->add->bind_param("ssi",$username,$sex,$age);
        $this->add->execute();
    }

    public function deleteInfo($username){
        $this->delete->bind_param("s",$username);
        $this->delete->execute($username);
    }

    public function searchInfo($username){
        $this->select->bind_param("s",$username);
        $this->select->execute();
        return $this->select->get_result();
    }

    public function updateInfo($username,$age,$sex){
        $this->update->bind_param("iss",$age,$sex,$username);
        $this->update->execute();
    }
}
