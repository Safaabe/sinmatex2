<?php
session_start();

// Database connection settings
$host = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'sinmatexdb';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = @$_GET["ref"];
$stmt = $conn->prepare("SELECT * FROM commandes WHERE id=? LIMIT 1"); 
$stmt->bind_param("i", $id); // Bind parameter to prevent SQL injection
$stmt->execute();
$result = $stmt->get_result();

// Fetch the command
$commande = $result->fetch_assoc();

// Check if command exists
if (!$commande) {
   header("Location:commande.php");
   exit; // Stop further execution
}

// Update the command status
$sql = "UPDATE commandes SET fini = 1 WHERE id = ?";
$query = $conn->prepare($sql);
$query->bind_param("i", $id); // Bind parameter to prevent SQL injection
$query->execute();

echo "<script>alert('Commande est considéré comme fini !');</script>";
echo "<script>window.location.href='commande.php'</script>";

?>