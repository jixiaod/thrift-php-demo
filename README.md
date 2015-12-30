### Thrif Demo
This is a demo code of thrift rpc that using php language.

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
