<?php include_once("header.php");?>



<?php
    if(!isset($_REQUEST["email"]) || !isset($_REQUEST["token"])){
        header('location:'.BASE_URL);
    }
    // check if the users email and token exists in database
    $statement = $pdo->prepare("SELECT * FROM users WHERE email=? AND token=?");
    $statement->execute([$_REQUEST['email'], $_REQUEST['token']]);
    $total = $statement->rowCount();

    if($total){
        //updating users toen and status
        $statement = $pdo->prepare("UPDATE users SET token=?, status=? WHERE email=? AND token=?");
        $statement->execute(['', 1,$_REQUEST['email'], $_REQUEST['token']]);

        header('location:'. BASE_URL. 'registration-success.php');
    }else{
        header('location:'.BASE_URL);
    }

?>




<?php include_once("footer.php"); ?>