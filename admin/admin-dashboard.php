<?php 
ob_start();
session_start();

include_once("functions.php");

define('BASE_URL', 'http://localhost/library-management/');
?>
<?php if(!isset($_SESSION["admins"])){
    header('location:'. BASE_URL);
    exit;
}
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
            <a class="navbar-brand" href="admin-dashboard.php">Library Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <font style="color: white;"><span><strong>Welcome <?php echo $_SESSION["admins"]["username"]; ?></strong></span></font>
                <font style="color: white;"><span><strong>Email ID: <?php echo $_SESSION["admins"]["email"] ?></strong></span></font>


                <ul class="nav navbar-nav navbar-right">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Profile
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo BASE_URL;?>admin/view-profile.php">View Profile</a>
                            <a class="dropdown-item" href="<?php echo BASE_URL;?>admin/edit-profile.php">Edit Profile</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL;?>admin/logout.php">Logout</a>
                    </li>
                    
                </ul>
        </div>
    </nav>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin-dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Books
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Add New Books</a>
                            <a class="dropdown-item" href="#">Manage Books</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Category
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Add New Category</a>
                            <a class="dropdown-item" href="#">Manage Category</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Author
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Add New Authors</a>
                            <a class="dropdown-item" href="#">Manage Authors</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-dashboard.php">Issue Books</a>
                    </li>
                    


                </ul>
            </div>
        </div>
    </nav>




    <span><marquee>This is library management system project.</marquee></span><br><br>
    <?php
    if(!isset($_SESSION["admins"])){
        header("location:". BASE_URL. "admin/index.php");
        exit;
    }
    ?>

    <div class="row">
        <div class="col-md-3">
            <div class="card bg-light" style="width:300px ;">
                <div class="card-header">Register Users:</div>
                <div class="card-body">
                    <p class="card-text">Number of total users: <?php echo get_user_count(); ?></p>
                    <a href="" class="btn btn-danger" target="_blank">View Registered Users</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-light" style="width:300px ;">
                <div class="card-header">Register Books:</div>
                <div class="card-body">
                    <p class="card-text">Number of available Books: <?php echo get_book_count(); ?></p>
                    <a href="" class="btn btn-primary" target="_blank">View Registered Books</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-light" style="width:300px ;">
                <div class="card-header">Register Category:</div>
                <div class="card-body">
                    <p class="card-text">Number of total Category: <?php echo get_category_count(); ?></p>
                    <a href="" class="btn btn-danger" target="_blank">View Catagories</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-light" style="width:300px ;">
                <div class="card-header">Register Authors:</div>
                <div class="card-body">
                    <p class="card-text">Number of total Authors: <?php echo get_authors_count(); ?></p>
                    <a href="" class="btn btn-primary" target="_blank">View Authors</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 m-auto">
            <div class="card bg-light " style="width:300px ;">
                <div class="card-header"> Issues Books:</div>
                <div class="card-body">
                    <p class="card-text">Number of Issues Books: <?php echo get_issued_books_count(); ?></p>
                    <a href="" class="btn btn-success" target="_blank">View Issues Books</a>
                </div>
            </div>
        </div>

    </div>

    

    
</body>
</html>
