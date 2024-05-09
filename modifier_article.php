<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'sinmatexdb';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

$query_clients = $conn->prepare("SELECT * FROM `clients` ");
$query_clients->execute();
$result_clients = $query_clients->get_result(); // Get the result set
$clients = $result_clients->fetch_all(MYSQLI_ASSOC);

// Check if article ID is provided in the URL
if(isset($_GET['id'])) {
    $article_id = $_GET['id'];
    
    // Handle form submission for updating article details
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Extract form data
        $nom = $_POST["nom"];
        $desc = $_POST["desc"];
        $id_client = $_POST["id_client"];
        
        // Update article details in the database
        $query_update_article = $conn->prepare("UPDATE articles SET nom_article = ?, desc_article = ?, id_client = ? WHERE id = ?");
        $query_update_article->bind_param("ssii", $nom, $desc, $id_client, $article_id);
        
        if ($query_update_article->execute()) {
            echo "Article mis à jour avec succès!";
            echo "<script>window.location.href='article.php'</script>";
        } else {
            echo "Erreur lors de la mise à jour de l'article: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.0.7/css/boxicons.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #eee;
           
            font-family: "Rubik", sans-serif;
           
        }

        .header {
            width: 100%;
            height: 50px;
            background-color: #fff;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            padding-top: 60px;
            background-color: #102C57;
            height: 100vh;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar img {
            width: 155px;
            height: 50px;
            padding-bottom: 30px;
            margin-left: 10px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        ul li a {
            text-decoration: none;
            color: #fff;
            padding: 10px;
            display: block;
            font-size: 15px;
        }

        ul li i {
            margin-right: 10px;
        }
        .form {
            margin-left: 220px;
            margin-top: 75px;
            border: 1px solid transparent;
            box-shadow: 6px 6px 6px 6px rgba(0, 0, 0, 0.1);
            padding-left: 20px;
            background-color: #fff;
            border-radius: 15px;
            width: 1090px;
            height: 490px;
        }

        .form input[type="text"],
        .form input[type="submit"],
        .form input[type="file"] .form select {
            display: block;
            margin-bottom: 15px;
            width: 900px;
            height: 18px;
            border-radius: 8px;
            border: 1px solid gray;
        }

        .form input[type="submit"] {
            background-color: #102C57;
            color: #fff;
            font-family: bold;
            font-size: 16px;
            height: 32px;
            width:600px;
            margin-left: 90px;

        }

        

        .form select {
            display: block;
            margin-bottom: 30px;
            width: 900px;
            height: 23px;
            border-radius: 8px;
            border: 1px solid gray;
        }

        .form label {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
        }
       

        
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
        </div>

        <div class="sidebar">
            <div class="logo"><img src="img/sinmatex.png" alt="simatex"></div>
            <ul>
                <li><a href="dashboard.php"><i class='bx bx-line-chart' style='color:#ffffff'></i> Dashboard</a></li>
                <li><a href="client.php"><i class='bx bxs-group' style='color:#ffffff'></i>Clients</a></li>
                <li><a href="commande.php"><i class='bx bx-box'></i>Commandes</a></li>
                <li><a href="fournisseur.php"><i class='bx bxs-pie-chart-alt' style='color:#ffffff'></i>Fournisseurs</a></li>
                <li><a href="achat.php"><i class='bx bxs-cylinder' style='color:#ffffff'></i>Achats</a></li>
                <li><a href="article.php"><i class='bx bxs-t-shirt'></i>Tous les articles</a></li>
                <div style="margin-top: 220px;"></div>
                <li><a href="logout.php"><i class='bx bx-log-out'></i>Déconnexion</a></li>
            </ul>
        </div>
        <div class="form">
            <h2>Modifier Article</h2>
            <form method="post" enctype="multipart/form-data" class="ajouter">
                <label for="">Nom d'article:</label>
                <input type="text" name="nom">
                <label for="">Description:</label>
                <input type="text" name="desc">
                <label for="">Clients:</label>
                <select name="id_client">
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client["id"] . '">' . $client["nomClient"] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Modifier Article">
            </form>
        </div>
    </div>
  </section>
    </div>



</body>

</html>