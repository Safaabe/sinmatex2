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

// Get the article ID from the URL parameter
$article_id = $_GET["ref"];

// Prepare and execute query to fetch article information
$stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->bind_param("i", $article_id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

// Check if the article exists
if (!$row) {
    echo "<script>alert('Cet article n'existe pas !');</script>";
    // Handle the case where the article doesn't exist
    // Redirect or display an error message
}

// Fetch the client information associated with the article
$stmt = $conn->prepare("SELECT * FROM clients WHERE id = ?");
$stmt->bind_param("i", $row["id_client"]);
$stmt->execute();
$client = $stmt->get_result()->fetch_assoc();

// Close the database connection
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title>
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
        .main{
            margin-left: 230px;
            margin-top: 80px;
            border: 1px solid transparent;
            box-shadow: 6px 6px 6px 6px rgba(0, 0, 0, 0.1);
            padding-left: 20px;
            background-color: #fff;
            border-radius: 15px;
        }
       .main input[type="text"],
       .main input[type="submit"]{
       display: block;
       margin-bottom: 30px;
       width: 680px;
       height: 25px;
       border-radius: 8px;
       border: 1px solid gray;
       }
       .main input[type="submit"]{
        background-color: #102C57;
        color: #fff;
        font-family: bold;
        font-size: 18px;
        height: 35px;
        width: 500px;
        margin-left: 170px;
        
       }
       
       .main input[type="date"]{
       display: block;
       margin-bottom: 30px;
       width: 250px;
       height: 25px;
       border-radius: 8px;
       border: 1px solid gray;
       }
       label{
        font-weight: 600;
       }

       .taille input[type="text"] {
            display: inline-block;
            width: 140px; /* Adjust the width as needed */
            margin-right: 10px; /* Adjust the margin as needed */
            border-radius: 8px;
        }
        
        .taille label{
           margin-bottom: 50px;
           font-weight: 600;
        }
        
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="margin-left: 220px;font-size:17px;margin-top:15px;color:#102C57;">Commandes</h2>
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
        <div class="main">
            <h2>Bon de Commande</h2>
          <form method="post" class="form">
            <label for="">Article ref:</label>
            <input type="text" name="ref" value="<?php echo $row["id"]; ?>" >
             <label for="">Nom de client:</label>
             <input type="text" id="client_name" name="nom_client" value="<?php echo isset($client["nomClient"]) ? $client["nomClient"] : ''; ?>">
             <label for="">Nom d'article:</label>
             <input type="text" id="article_name" name="nom_article" value="<?php echo isset($row["nom_article"]) ? $row["nom_article"] : ''; ?>">

             <div class="taille">
                <label for="">taille S:</label>
             <input type="text" name="taille_s" value="0">
             <label for="">taille M:</label>
             <input type="text" name="taille_m" value="0">
             <label for="">taille L:</label>
             <input type="text" name="taille_l" value="0">
             <label for="">taille X:</label>
             <input type="text" name="taille_x" value="0">
             <label for="">taille XL:</label>
             <input type="text" name="taille_xl" value="0">
             <label for="">taille 2XL:</label>
             <input type="text" name="taille_2xl" value="0">
             <label for="">taille 3XL:</label>
             <input type="text" name="taille_3xl" value="0">
             </div>
             <label for="">Date de commande:</label>
             <input type="date" name="date_commande">
             <label for="">Data de livraison:</label>
             <input type="date" name="date_livraison"> 
             <input type="submit"  name="nv_submit" value="Crée commande">
          </form>
        </div>
    </div>

    

</body>

</html>
<?php
    // Create a new connection
    $conn2 = new mysqli($host, $username, $password, $dbname);

    // Check the new connection
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
    }

    if (isset($_POST["nv_submit"])) {
        // Get values from the form
        $id_article = $article_id; // Corrected: Use the fetched article ID
        $id_client = $row["id_client"]; // Corrected: Use the fetched client ID
        $s = intval($_POST["taille_s"]);
        $m = intval($_POST["taille_m"]);
        $l = intval($_POST["taille_l"]);
        $x = intval($_POST["taille_x"]);
        $xl = intval($_POST["taille_xl"]);
        $xxl = intval($_POST["taille_2xl"]);
        $xxxl = intval($_POST["taille_3xl"]);
        $quantity = $s + $m + $l + $x + $xl + $xxl + $xxxl; // Calculate total quantity

        $date_commande = $_POST["date_commande"];
        $date_livraison = $_POST["date_livraison"];
        $fini = false; // Assuming it's not finished initially

        // Insert the order into the database
        $sql = "INSERT INTO commandes (articleRef, id_client, taille_s, taille_m, taille_l, taille_x, taille_xl, taille_2xl, taille_3xl, quantity, date_commande, date_livraison, fini) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $conn2->prepare($sql);
        $query->bind_param('iiiiiiiiissss', $id_article, $id_client, $s, $m, $l, $x, $xl, $xxl, $xxxl, $quantity, $date_commande, $date_livraison, $fini);
        $query->execute();

        echo "<script>alert('Commande a été bien ajoutée !');</script>";
        echo "<script>window.location.href='commande.php'</script>";
    }

    // Close the second connection
    $conn2->close();
    ?>