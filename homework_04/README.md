**增删改查接口文档**

1. 登录

url：http://localhost/interface.php

| 参数形式  | 参数类型 | 参数解释 |  示例  |
| :-------: | :------: | :------: | :----: |
| username  |  string  | 用户账号 | Leotan |
|    pwd    |  string  | 用户密码 | dsfasd |
| operation |  string  |   操作   | login  |

* 返回示例    

```json
{
	"code":"0",
	"message":"success"
}
```

2. 注册

url：http://localhost/interface.php

| 参数形式  | 参数类型 | 参数解释 |  示例   |
| :-------: | :------: | :------: | :-----: |
| username  |  string  | 用户账号 | Leotan  |
|    pwd    |  string  | 用户密码 | dsfasd  |
| operation |  string  |   操作   | sign-up |

* 返回示例    

```json
{
	"code":"0",
	"message":"success"
}
```

3. 改密码

url：http://localhost/interface.php

|  参数形式   | 参数类型 | 参数解释 |    示例    |
| :---------: | :------: | :------: | :--------: |
|  username   |  string  | 用户账号 |   Leotan   |
|     pwd     |  string  | 用户密码 |   dsfasd   |
|  operation  |  string  |   操作   | change-pwd |
| changed-pwd |  string  |  新密码  |   asdfgh   |

* 返回示例    

```json
{
	"code":"0",
	"message":"success"
}
```

4. 注销

url：http://localhost/interface.php

| 参数形式  | 参数类型 | 参数解释 |   示例    |
| :-------: | :------: | :------: | :-------: |
| username  |  string  | 用户账号 |  Leotan   |
|    pwd    |  string  | 用户密码 |  dsfasd   |
| operation |  string  |   操作   | login-out |

* 返回示例    

```json
{
	"code":"0",
	"message":"success"
}
```

