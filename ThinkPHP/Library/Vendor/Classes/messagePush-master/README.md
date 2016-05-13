# messagePush
这个类库可以配合[message-push](https://github.com/wqwz111/message-push)服务使用。

## 使用方法

1. 在web项目中引入该类库
2. 简单例子
```php
    $config = array(
      'from' => '123',
      'to' => '',
      'content' => 'hello',
      'viewlevel' => '1',
      'action' => '1');
    $result = Pusher::push((new MessageBuilder($config))->build());
    echo $result;
```
