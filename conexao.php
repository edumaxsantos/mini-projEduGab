<?php
class Conexao {

    public static $instance;

    private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=localhost;dbname=loja', 'root', '',
 array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;
    }

}


/*require_once __DIR__ . '/src/vendor/autoload.php';
 
$config = new \Doctrine\DBAL\Configuration();
 
$connectionParams = array(
    'dbname' => 'loja',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'port' => 3306,
    'charset' => 'utf8',
    'driver' => 'pdo_mysql',
);
$dbh = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);*/
?>