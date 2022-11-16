<?php
/**
 * @param $token 检查token是否合法
 * @param $name 检查token是否符合name
 * @return bool
 */

function check($token,$name){
    $log_sql = connect_sql("log");
    $res = select_sql($log_sql,"test","where token=\"$token\"");
    $res = mysqli_fetch_assoc($res);
    if($res!=null){
        if ($res["name"]==$name&&$res["token"]==$token){
            print($res["name"]);
            return true;
        }
        echo "failure";
//        print($res[0]);
        return false;
    }else{
        echo "failure";
        return false;
    }
}

/**
 * @param $username 用户名
 * @param $password 密码
 * @return string|null 登陆成功返回token，否则返回false
 */
function register($username,$password){//验证登录
    if (strcmp($username,"Leo")==0&&strcmp($password,"passwords")==0){
        $token = get_rand_str(20);
        $conn = connect_sql("log");
        $res = select_sql($conn,'test',"where username=\"$username\"");
        if ($res!=null){
            return $res["token"];
        }
        $sql = "INSERT INTO test VALUES (\"$username\",\"$token\")";
        mysqli_query($conn,$sql);
        return $token;
    }else{
        return null;
    }
}//注册信息，返回token
/**
 * @param $lenth 生成随机字符串的长度
 * @return string
 */
function get_rand_str($lenth){//随机生成token
    $pattern="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPALSKDJFHGZMXNCBV1234567890";
    $str="";
    for ($i=0;$i<$lenth;$i++) {
        $str .= $pattern{(mt_rand(0, 35))};
//        echo $str;
    }

    return $str;
}

/**
 * @param $dbname 数据库名字
 * @return mysqli|null
 */
function connect_sql($dbname){//连接数据库
    $serve_ip = "localhost";
    $username = "root";
    $pwd = "root";
    $connect = new mysqli($serve_ip,$username,$pwd,$dbname);
    if ($connect->connect_error){
        echo "连接失败".$connect->connect_error;
        return null;
    }
    return $connect;
}//连接数据库，返回数据库对象
function select_sql($sql_conn,$dbname,$condition){//查询数据库
    $sql = "SELECT * FROM $dbname $condition";
    return mysqli_query($sql_conn,$sql);
}
function add_sql($sql_conn,$dbname,$value){
    $sql = "insert into $dbname values($value)";
    echo $sql;
    mysqli_query($sql_conn,$sql);
}
function update_sql($sql_conn,$dbname,$what,$conditions){
    $sql = "update $dbname set $what $conditions";
//    $sql = "update users set values = '3412' where users = 'Tony'";
    echo $sql;
    mysqli_query($sql_conn,$sql);
}
function del_sql($sql_conn,$dbname,$condition){
    $sql = "delete from $dbname $condition";
    mysqli_query($sql_conn,$sql);
}
function request($op,$words,$value,$condition,$what){
    $sql_conn = connect_sql("user");
    switch ($op){
        case "select":
            $res = select_sql($sql_conn,"users",$condition);
            $result=mysqli_fetch_assoc($res);
            while($result!=null){
                print($result[$words]."<br>");
                $result = mysqli_fetch_assoc($res);
            }
//            print($res["users"]);
            break;
        case "add":
            add_sql($sql_conn,"users",$value);
            break;
        case "update":
            update_sql($sql_conn,"users",$what,$condition);
            break;
            case "delete":
                del_sql($sql_conn,"users",$condition);
            break;
        default:
            echo null;
    }
    $sql_conn->close();
}

/**
 * name必须为Leo
 * password必须为passwords
 */
$op = $_POST['operation'];//select、update、add、delete
$value = $_POST['value'];
$name = $_POST['name'];
$pwd = $_POST['pwd'];
$token = $_POST['token'];
$condition = $_POST['condition'];
$words = $_POST['words'];
$what = $_POST['what'];
if ($name!=null&&$pwd!=null){
    $token = register($name,$pwd);
    echo $token;
    request($op,$words,$value,$condition,$what);
}else{
    if($token!=""&&check($token,$name)){
        request($op,$words,$value,$condition,$what);
    }
}
?>
