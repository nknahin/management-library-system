<?php 

ob_start();
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once("config.php");
define('BASE_URL', 'http://localhost/management-library-system/');
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="css/bootstrap.min.css">
    <title>Library Management System</title>
    <style type="text/css">
        #side_bar{
            background-color: whitesmoke;
            padding: 50px;
            width: 300px;
            height: 450px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Library Management System</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/index.php">Admin Login</a>
                </li>

                <?php if(!isset($_SESSION["user"])):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>login.php">User Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>registration.php">Registration</a>
                </li>
                <?php endif;?>

                <?php if(isset($_SESSION["user"])):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>library.php">Library</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>logout.php">Logout</a>
                </li>
                <?php endif;?>

            </ul>
        </div>
    </nav><br>
    <span><marquee>This is library management system project.</marquee></span><br><br>