<?php
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

function mysql_connect(){
    $database = [
        'driver' => 'mysql',
        'url' => '',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'symfony',
        'username' => 'root',
        'password' => 'root',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => null,
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::MYSQL_ATTR_SSL_CA => '',
        ]) : [],
    ];
    
    $capsule = new Capsule;
    
    // 创建链接
    $capsule->addConnection($database);
    
    // 设置全局静态可访问DB
    $capsule->setAsGlobal();
    
    // 启动Eloquent
    $capsule->bootEloquent();

    return $capsule;
}
mysql_connect();