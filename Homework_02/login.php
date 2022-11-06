<?php
function get_rand_str($lenth){
    $pattern="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPALSKDJFHGZMXNCBV1234567890";
    $str="";
    for ($i=0;$i<$lenth;$i++){
        $str.=$pattern{(mt_rand(0,35))};
    }
    return $str;
}
$name = $_POST["id"];
$pwd = $_POST["pwd"];
$token="";
if (strcmp($name,"LeoTan")==0&& strcmp($pwd,"Leon")==0){//实际中可能要在数据库中完成的查询操作
    $token = get_rand_str(50);
    echo "{ token:".$token."}";//生成后应该用数据库储存起来，存储时记得需要记录时间、Mac地址等关键信息，保障信息安全
}else{
    echo "wrong answer";
}
?>
