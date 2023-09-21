<?php


define('BASE_URL', 'http://localhost/library-management/');
?>

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

<?php

// ...

if (isset($_POST['username'], $_POST['email'], $_POST['phone'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Check if the user exists in the database
    $statement = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $statement->execute([$email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Update their details
        $statement = $pdo->prepare("UPDATE admins SET username = ?, phone = ? WHERE email = ?");
        $statement->execute([$username, $phone, $email]);

        // Redirect to the admin-dashboard.php page
        header('location:' . BASE_URL . 'admin/admin-dashboard.php');
        exit;
    } else {
        // User does not exist
        header('location:' . BASE_URL. 'admin/index.php');
        exit;
    }
} else {
    header('location:' . BASE_URL);
    exit;
}
?>

