<?php 
ob_start();
session_start();

define('BASE_URL', 'http://localhost/library-management/');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <title>Library Management System</title>
    <style type="text/css">
        #side_bar {
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
            <a class="navbar-brand" href="admin/admin-dashboard.php">Library Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <font style="color: white;"><span><strong>Welcome: <?php echo $_SESSION["admins"]["username"] ?></strong></span></font>
                <font style="color: white;"><span><strong>Email ID: <?php echo $_SESSION["admins"]["email"] ?></strong></span></font>


                <ul class="nav navbar-nav navbar-right">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Profile
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="view-profile.php">View Profile</a>
                            <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                            <a class="dropdown-item" href="<?php echo BASE_URL;?>admin/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
        </div>
    </nav><br>
    <span><marquee>This is library management system project.</marquee></span><br><br>

    <?php
    if(!isset($_SESSION["admins"])){
        header("location:". BASE_URL. "admin/index.php");
        exit;
    }
    ?>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="admin-update.php" method="post">
                <center><h6><i>Note: If you click on the update button your data will be updated and you will automatically logged out.</i></h6></center>
                <div class="form-group">
                    <label for="">Username:</label>
                    <input type="text" class="form-control" value="<?php echo $_SESSION["admins"]["username"];?>" name="username">
                </div><br>
                <div class="form-group">
                    <label for="">Phone:</label>
                    <input type="text" class="form-control" value="<?php echo $_SESSION["admins"]["phone"]; ?>" name="phone">
                </div><br>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>







   
</body>
</html>
