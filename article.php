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

$query_articles = $conn->prepare("SELECT * FROM `articles` ");
$query_articles->execute();
$result_articles = $query_articles->get_result(); // Get the result set
$articles = $result_articles->fetch_all(MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $desc = $_POST["desc"];
    $id_client = $_POST["id_client"];
    $uploadOk = 1;

    // Handle image upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Check file size
            if ($_FILES["image"]["size"] > 5000000) { // Adjust size limit as needed
                echo "Désolé, votre fichier est trop volumineux.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
                $uploadOk = 0;
            }
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "L'image " . htmlspecialchars(basename($_FILES["image"]["name"])) . " a été téléchargée avec succès.";

                    // Insert data into database only if image upload is successful
                    $query_insert_article = $conn->prepare("INSERT INTO articles (nom_article, desc_article, image_article, id_client) VALUES (?, ?, ?, ?)");
                    $query_insert_article->bind_param("sssi", $nom, $desc, $target_file, $id_client);
                    if ($query_insert_article->execute()) {
                        echo "Article ajouté avec succès!";
                    } else {
                        echo "Erreur lors de l'ajout de l'article: " . $conn->error;
                    }
                } else {
                    echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
                }
            }
        } else {
            echo "Le fichier n'est pas une image valide.";
            $uploadOk = 0;
        }
    } else {
        echo "Erreur: Aucune image téléchargée.";
        $uploadOk = 0;
    }

    if ($uploadOk != 1) {
        echo "Tous les champs doivent être remplis!";
    }
}

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
        .form input[type="submit"],
        .form input[type="file"] .form select {
            display: block;
            margin-bottom: 15px;
            width: 260px;
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
        .customTable {
    width: 95%; /* Adjust the width as needed */
    max-width: 800px; /* Set a maximum width */
    margin-left: 20px; /* Center the table horizontally */
    margin-right: auto;
    background-color: #FFFFFF;
    border-collapse: collapse;
    border-width: 2px;
    border-color: #0a2558;
    border-style: solid;
    color: #000000;
    margin-top: 20px;
   
}

table.customTable thead {
    color: white;
    background-color: #0a2558;
}

table.customTable td,
table.customTable th {
    border-width: 2px;
    border-color: #081d45;
    border-style: solid;
    padding: 5px;
    width: auto; /* Let the width adjust automatically */
}
.p2{
    border: 1px solid transparent;
    border-radius: 15px;
    box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1);
    margin-left: 600px;
    position: absolute;
    top: 75px;
    max-width: 750px;
    height: 400px;
    background-color: #fff;
  
        
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
            <form method="post" enctype="multipart/form-data" class="ajouter">
                <label for="">Nom d'article:</label>
                <input type="text" name="nom">
                <label for="">Description:</label>
                <input type="text" name="desc">
                <label for="">Image:</label>
                <input type="file" name="image">
                <label for="">Clients:</label>
                <select name="id_client">
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client["id"] . '">' . $client["nomClient"] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Ajouter Article">
            </form>
        </div>
        <div style="width:80%" class="p2" >
            <table class="customTable">
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Client</th>
                        <th>Modifier</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?php echo $article['id']; ?></td>
                    <td><img src="<?php echo $article['image_article']; ?>" alt="Article Image" style="width: 60px;"></td>
                    <td><?php echo $article['nom_article']; ?>-<?php echo $article['desc_article']; ?></td>
                    <td>
                        <?php 
                        // Fetch client name based on client id
                        $client_id = $article['id_client'];
                        $client_name = '';
                        foreach ($clients as $client) {
                            if ($client['id'] == $client_id) {
                                $client_name = $client['nomClient'];
                                break;
                            }
                        }
                        echo $client_name;
                        ?>
                    </td>
                    <td style="width: 20px;">
    <a href="modifier_article.php?id=<?php echo $article['id']; ?>">
        <i style="font-size: 20px;color: #FDDA0D !important" class="bx bx-edit"></i>
    </a>
    <a href="./supprimer.php?ref=<?php echo $article['id']; ?>">
        <i style="font-size: 20px;color: #FF0000 !important" class="bx bx-trash"></i>
    </a>
</td>
                </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
