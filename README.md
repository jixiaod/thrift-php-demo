### Thrif Demo
This is a demo code of thrift rpc that using php language.

### Require

[Thritf Install](http://thrift.apache.org/docs/install/os_x)

### Generate Code

```
    ~# thrift -r -gen php:server demo.thrift
```

### Run Server

```
    ~# cd php
    ~# python runserver.py
```

### Run Client

```
    ~# cd php
    ~# php PhpClient.php --http
```
