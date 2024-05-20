<?php

$host = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'sinmatexdb';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

$id = isset($_GET["ref"]) ? $_GET["ref"] : null;

if (!$id) {
    header("Location: achat.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM achats WHERE id_achat = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$article = $stmt->get_result()->fetch_assoc();

if (!$article) {
    header("Location: achat.php");
    exit;
}

// Proceed with deletion
$sql = "DELETE FROM achats WHERE id_achat = ?";
$query = $conn->prepare($sql);
$query->bind_param('i', $id);
$query->execute();

header("Location: achat.php");
exit;
?>
