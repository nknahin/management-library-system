<?php include_once("header.php");?>


<?php
if(!isset($_SESSION["user"])){
    header("location:". BASE_URL. "login.php");
    exit;
}

?>


<div class="container">
    <div class="col-lg-12 ml-50">
        <center><h2>This is main library</h2><br>
        <div class="col-md-12">
            <p>Hi <?php echo $_SESSION["user"]['firstname'];  ?>, Welcome to Dashboard.</p>
        </div>
    </div>
    </center>
</div> <br><br>


<?php include_once("footer.php"); ?>