<?php
// Se connecter à la base de données

try 
{
    $bdd = new PDO("mysql:host=localhost;dbname=TP_PHP_Mysql_JS_Boostrap;charset=utf8", "root", "mbayang07");
}
catch(PDOException $e)
{
    die('Erreur : '.$e->getMessage());
}


?>