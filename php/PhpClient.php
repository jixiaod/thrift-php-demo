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


use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;

try {
  if (array_search('--http', $argv)) {
    $socket = new THttpClient('localhost', 8080, '/php/PhpServer.php');
  } else {
    $socket = new TSocket('localhost', 9090);
  }
  $transport = new TBufferedTransport($socket, 1024, 1024);
  $protocol = new TBinaryProtocol($transport);
  $client = new \demo\FooClient($protocol);

  $transport->open();

  $user = $client->getUserInfo(1);
  var_dump($user);

  $transport->close();

} catch (TException $tx) {
  print 'TException: '.$tx->getMessage()."\n";
}

?>
