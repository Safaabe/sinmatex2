<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'sinmatexdb';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if 'ref' parameter is set
    if(isset($_GET["ref"])) {
        $id = $_GET["ref"];
        
        // Prepare and execute the SELECT query
        $stmt = $conn->prepare("SELECT * FROM articles WHERE id = :id LIMIT 1"); 
        $stmt->bindParam(':id', $id);
        $stmt->execute(); 
        
        // Fetch the article
        $article = $stmt->fetch();
        
        // Check if article exists
        if(!$article){
            header("Location: article.php");
            exit(); // Stop further execution
        }

        // Prepare and execute the DELETE query
        $sql = "DELETE FROM articles WHERE id= :id";
        $query = $conn->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();

        // Redirect to article.php after successful deletion
        header("Location: article.php");
        exit(); // Stop further execution
    } else {
        echo "No 'ref' parameter provided.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
