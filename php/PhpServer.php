#!/usr/bin/env php
<?php

namespace tutorial\php;

error_reporting(E_ALL);

require_once __DIR__.'/../Thrift/ClassLoader/ThriftClassLoader.php';

use Thrift\ClassLoader\ThriftClassLoader;

$GEN_DIR = realpath(dirname(__FILE__).'/..').'/gen-php';

$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__ . '/../');
$loader->registerDefinition('demo', $GEN_DIR);
$loader->register();

if (php_sapi_name() == 'cli') {
  ini_set("display_errors", "stderr");
}

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TPhpStream;
use Thrift\Transport\TBufferedTransport;

class DemoHandler implements \demo\FooIf
{
    public function getUserInfo($uid) 
    {
        return new \demo\User(array('uid'=>$uid, 'name'=>'name', 'age'=>18));
    }
}

header('Content-Type', 'application/x-thrift');
if (php_sapi_name() == 'cli') {
  echo "\r\n";
}

$handler = new DemoHandler();
$processor = new \demo\FooProcessor($handler);

$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport, true, true);

$transport->open();
$processor->process($protocol, $protocol);
$transport->close();

