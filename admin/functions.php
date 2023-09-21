<?php
function get_user_count(){
    include_once("dbname.php");
    $user_count = 0; 
    try {
        $statement = $pdo->prepare("SELECT COUNT(*) as user_count FROM users");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $user_count = $result['user_count'];
        }
    } catch (PDOException $e) {
        echo "Error fetching user count: " . $e->getMessage();
    }
    return $user_count;
}


function get_book_count(){
    $dbhost = "localhost";
    $dbname = "library_management_system";
    $dbuser = "root";
    $dbpass = "";

    try{
        $pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection error: " . $e->getMessage();
    }
    $books_count = 0; 

    try {
        $statement = $pdo->prepare("SELECT COUNT(*) as user_count FROM books");
        $statement->execute();
        
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $books_count = $result['user_count'];
        }
    } catch (PDOException $e) {
        echo "Error fetching user count: " . $e->getMessage();
    }

    return $books_count;
}



function get_category_count(){
    $dbhost = "localhost";
    $dbname = "library_management_system";
    $dbuser = "root";
    $dbpass = "";

    try{
        $pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection error: " . $e->getMessage();
    }

    $category_count = 0; 

    try {
        $statement = $pdo->prepare("SELECT COUNT(*) as user_count FROM category");
        $statement->execute();
        
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $category_count = $result['user_count'];
        }
    } catch (PDOException $e) {
        echo "Error fetching user count: " . $e->getMessage();
    }

    return $category_count;
}


function get_authors_count(){
    $dbhost = "localhost";
    $dbname = "library_management_system";
    $dbuser = "root";
    $dbpass = "";
    try{
        $pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection error: " . $e->getMessage();
    }
    $authors_count = 0; 
    try {
        $statement = $pdo->prepare("SELECT COUNT(*) as user_count FROM authors");
        $statement->execute();
        
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $authors_count = $result['user_count'];
        }
    } catch (PDOException $e) {
        echo "Error fetching user count: " . $e->getMessage();
    }
    return $authors_count;
}


function get_issued_books_count(){
    $dbhost = "localhost";
    $dbname = "library_management_system";
    $dbuser = "root";
    $dbpass = "";

    try{
        $pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection error: " . $e->getMessage();
    }

    $books_count = 0; 

    try {
        $statement = $pdo->prepare("SELECT COUNT(*) as user_count FROM books");
        $statement->execute();
        
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $books_count = $result['user_count'];
        }
    } catch (PDOException $e) {
        echo "Error fetching user count: " . $e->getMessage();
    }

    return $books_count;
}
?>
