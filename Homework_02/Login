# login

## What is Token

根据自己在网上找的一些资料和学长们的帮助，我发现一种权限管理的方式，那就是`token`身份识别。

> Token是什么？. 所谓的Token，其实就是**服务端生成的一串加密字符串、以作客户端进行请求的一个“令牌**”。. 当用户第一次使用账号密码成功进行登录后，服务器便生成一个Token及Token失效时间并将此返回给客户端，若成功登陆，以后客户端只需在有效时间内带上这个Token前来请求数据即可，无需再次带上用户名和密码。

这样不仅可以尽可能的保护用户的登录密码安全，也可以是数据传输更加快捷，那么如何实现**token**呢？

## Token的实现

首先token不是那个语言特有的数据类型，他只是一个经过加密的字符串。所以实现可以使用任何语言。这里使用的是 **PHP**

```sequence
Client->>Serve:请求登录（账号&密码）
Serve->>Client:验证身份，身份核验通过，返回随机字符串（Token）
Client->>Serve:保存密码，以后访问都直接使用Token，知道token过期，重新登录

```

那么在服务器这衣服按所需要实现的功能便是验证身份，生成随机字符串并储存

由于本人水平有限，只能写出验证身份和随机字符串的生成

```php
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
```

