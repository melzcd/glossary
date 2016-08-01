<?php
$host = '127.0.0.1';
$db = 'glossary';
$userdb = 'root';
$passdb ='';
$charset = 'utf8';
//$port = '5432';

 $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
 //$dsn = "pgsql:dbname=$db;host=$host;port=$port";

 //$dbh = new PDO("pgsql:dbname=$dbname;host=$host", $dbuser, $dbpass);

$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$db = new PDO($dsn, $userdb, $passdb, $opt);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$db->exec("set names utf8");
?>
