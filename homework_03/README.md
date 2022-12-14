# MySql数据库的增删改查

## 安全验证

数据库作为重要数据资料的存储的保险柜，当然需要一把足够安全的锁来保护我们的数据安全，这里我使用的是`token`的方式，当然还有很多没有完善的地方，比如token的生存周期，用户的新建、用户更改密码(这里我只放了一个[“Leo”、“passwords”])等。同时也还没有考虑token的长度是否合理。有待完善。

这里的验证有两种方式：

- 账号密码验证：调用时的传参中如果有用户名和密码，则优先使用用户名和密码登录的方式，同时返回个客户端一个`token`，这里的token具有唯一性，也就是收不会无限制的先数据库插入token信息。
- token验证：调用时传入token和name，后台更具name和token是否匹配来判断是否安全。

对于安全方便还有一点需要提及的是（也是十分重要的）：sql注入问题

暂时还不会！

## 数据库操作

如果通过了安全验证，客户端便可以像后台发送数据库请求，请求的内容可以包括

| 字段      | 解释                                                         |            注意事项或用例            |
| --------- | ------------------------------------------------------------ | :----------------------------------: |
| operation | 操作的类型，可以为[select、update\、delete、add]             |              区分大小写              |
| value     | 传入值，用于add，                                            |     注意字符串要引号，无需打括号     |
| condition | 条件，在删改查是会用，可有可无，但是删除时最好加上，不然就寄了 | 需要加where<br/>`where name = "Leo"` |
| words     | 字段，一般在查的时候会用，如果时全部就用`*`                  |    无需加引号，以逗号分割多个字段    |
| what      | 改啥，没错，这个是用来改数据的，但是你必须指定改啥，咋改     |            `name = "Leo"`            |

## 缺陷和不足

1. 没有用户管理功能。
2. 没有用户输入合法验证功能
3. 没有输出限制功能，过量的输出结果可能导致网络拥堵
4. 无法对多个数据表或数据库操作
5. 无法新建数据库
6. 对于`operation`还有大小写区分，棒鲁性差
7. 对于`token`没有生存周期的处理
8. `token`长度是固定的，有可能影响安全性
9. 没有用户权限限制
10. 对于用户的操作没有安全保护（没有撤回功能、没有操作前**等待确认**功能）
