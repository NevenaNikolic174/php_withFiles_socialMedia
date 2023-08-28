<?php
$db_host = "localhost";
$db_name = "id20728324_webio";
$db_user = "id20728324_nevena";
$db_password = "Lozinka123!";

$dsn = "mysql:host=$db_host;dbname=$db_name";

try{
    $conn = new PDO($dsn, $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException){
    echo $e->getMessage();
}



?>