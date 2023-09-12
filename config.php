<?php
$dbhost= "localhost";
$dbname = "library_management_system";
$dbuser = "root";
$dbpass = "";

try{
    $pdo = new pdo("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Connection error:" . $e->getMessage();
}

?>