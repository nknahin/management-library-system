<?php

include_once("config.php");
define('BASE_URL', 'http://localhost/library-management/');

// Check if all the required fields are provided
if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Check if the user exists in the database
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $statement->execute([$email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User exists, update their details
        $statement = $pdo->prepare("UPDATE users SET firstname = ?, lastname = ?, phone = ? WHERE email = ?");
        $statement->execute([$firstname, $lastname, $phone, $email]);

        // Redirect to the profile view page with the user's ID as a query parameter
        header('location:' . BASE_URL . 'logout.php?user_id=' . $user['email']);
        exit;
    } else {
        // User does not exist, handle this case accordingly
        header('location:' . BASE_URL. 'registration.php');
        exit;
    }
} else {
    // Handle the case where not all required fields are provided
    header('location:' . BASE_URL);
    exit;
}
?>
