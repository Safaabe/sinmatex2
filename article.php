<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'sinmatexdb';



$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

// Requête SQL pour récupérer les noms des clients
$sql = "SELECT nomClient FROM clients";
$result = $conn->query($sql);

// Initialisation d'une variable pour stocker les options de la liste déroulante
$selectOptions = "";

// Si des clients sont trouvés, générer les options de la liste déroulante
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $selectOptions .= "<option value='" . $row["nomClient"] . "'>" . $row["nomClient"] . "</option>";
    }
} else {
    $selectOptions = "<option value=''>Aucun client trouvé</option>";
}

// Fermer la connexion à la base de données
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
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
            width: 350px;
        }

        .form input[type="text"],
        .form input[type="button"],
        .form input[type="file"] .form select {
            display: block;
            margin-bottom: 15px;
            width: 260px;
            height: 18px;
            border-radius: 8px;
            border: 1px solid gray;
        }

        .form input[type="button"] {
            background-color: #102C57;
            color: #fff;
            font-family: bold;
            font-size: 16px;
            height: 32px;
            width: 200px;
            margin-left: 50px;

        }

        .form input[type="file"] {
            display: block;
            margin-bottom: 30px;
            width: 250px;
            height: 23px;
            border-radius: 8px;
            border: 1px solid gray;
        }

        .form select {
            display: block;
            margin-bottom: 30px;
            width: 250px;
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
            <h2 style="margin-left: 220px;font-size:17px;margin-top:15px;color:#102C57;">Articles</h2>
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
            <h2>Ajouter un article</h2>
            <form action="" class="ajouter">
                <label for="">Nom d'article:</label>
                <input type="text" name="nom">
                <label for="">Description:</label>
                <input type="text" name="description">
                <label for="">Image:</label>
                <input type="file" name="image">
                <label for="">Clients:</label>
                <select name="client">
                    <?php echo $selectOptions; ?>
                    <input type="button" value="ajouter Article">
                </select>
            </form>
        </div>
        <div class="tab">

        </div>
    </div>



</body>

</html>