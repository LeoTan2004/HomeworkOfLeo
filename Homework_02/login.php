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
$nickName = $_POST["NickName"];
$token="";
if (strcmp($name,"LeoTan")==0&& strcmp($nickName,"Leon")==0){
    $token = get_rand_str(50);
    echo "{ token:".$token."}";
}else{
    echo $nickName,$name;
    echo "wrong answer";
}
?>
