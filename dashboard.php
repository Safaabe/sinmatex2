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

// Fetch total clients
$query = $conn->prepare("SELECT COUNT(*) as total_clients FROM clients");
$query->execute();
$result = $query->get_result();
$total_clients = $result->fetch_assoc()['total_clients'];

// Fetch total commandes
$query = $conn->prepare("SELECT COUNT(*) as total_commandes FROM commandes");
$query->execute();
$result = $query->get_result();
$total_commandes = $result->fetch_assoc()['total_commandes'];

// Fetch total articles
$query = $conn->prepare("SELECT COUNT(*) as total_articles FROM articles");
$query->execute();
$result = $query->get_result();
$total_articles = $result->fetch_assoc()['total_articles'];

// Fetch total commandes not finished
$query = $conn->prepare("SELECT COUNT(*) as total_commandes_pasfini FROM commandes WHERE fini = 0");
$query->execute();
$result = $query->get_result();
$total_commandes_pasfini = $result->fetch_assoc()['total_commandes_pasfini'];

// Fetch list of clients (if needed)
$query = $conn->prepare("SELECT * FROM clients");
$query->execute();
$clients = $query->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch list of commandes not finished (if needed)
$query = $conn->prepare("SELECT * FROM commandes WHERE fini = 0");
$query->execute();
$commandes = $query->get_result()->fetch_all(MYSQLI_ASSOC);

$conn->close();
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

        .sidebar .logo img {

            max-width: 155px;
            height: 50px;
            padding-bottom: 30px;
            margin-left: 10px;
            width: 250px;
            height: 55px;
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
        

        .cartes {
            display: flex;
            flex-direction: row;
            margin-left: 270px;
            margin-top: 90px;
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid transparent;
            border-radius: 10px;
            padding: 20px;
            margin-right: 18px;
            height: 70px;
            width: 190px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card h4 {
            position: absolute;
            top: 150px;
        }

        .client {
            border: 1px solid transparent;
            border-radius: 15px;
            width: 430px;
            height: 400px;
            background-color: #fff;
            margin-left: 250px;
            margin-top: 30px;
            display: flex;
        }

        .cmd {
            border: 1px solid transparent;
            border-radius: 15px;
            width: 600px;
            height: 300px;
            background-color: #fff;
            margin-left: 700px;
            position: absolute;
            top: 250px;
        }

        .card h4 {
            margin-top: -50px;
        }

        .icon {
            margin-left: 160px;
            margin-top: -65px;
        }

        .number {
            margin-top: 10px;
            font-size: 20px;
            font-weight: 600;
        }

        .bx-up-arrow-alt {
            background-color: #A0DEFF;
            border-radius: 50px;
            color: #fff;
        }

        .indicator {
            margin-top: 20px;
        }

        .top-sales-details {
            margin-top: 60px;
            margin-left: -30px;
            flex: 1;
        }

        .product {
            margin-left: 50px;
            color: #0d3073;
        }

        .sales-details {
            display: flex;
            flex-direction: row;
            gap: 20px;
            padding: 20px;
        }

        .details {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .voir {
            border-bottom: 10px;
            margin-left: 500px;
            margin-top: -30px;
        }

        .voir a {
            background-color: #0d3073;
            width: 70px;
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            padding: 7px;
            border: 1px solid transparent;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="margin-left: 220px;font-size:17px;margin-top:15px;color:#102C57;">dashboard</h2>
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
    </div>

    <section class="cartes">
        <div class="card">
            <h4>Commandes</h4>
            <div class="number"><?php echo $total_commandes; ?></div>
            <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
            </div>
            <div class="icon">
                <i class="bx bx-cart-alt cart" style="background-color: #A0DEFF;color:#5AB2FF;padding:8px;font-size:21px;border-radius:12px"></i>
            </div>
        </div>
        <div class="card">
            <h4>Clients</h4>
            <div class="number"><?php echo $total_clients; ?></div>
            <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
            </div>
            <div class="icon">
                <i class="bx bxs-cart-add cart two" style="background-color: #B6FFCE;color:#14C38E;padding:8px;font-size:21px;border-radius:12px"></i>
            </div>
        </div>
        <div class="card">
            <h4>Articles</h4>
            <div class="number"><?php echo $total_articles ?></div>
            <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
            </div>
            <div class="icon">
                <i class="bx bx-cart-alt cart" style="background-color: #FDE49E;color:#FF7F3E;padding:8px;font-size:21px;border-radius:12px"></i>
            </div>
        </div>
        <div class="card">
            <h4>Commandes <br>non fini</h4>
            <div class="number" style="margin-top:25px"><?php echo $total_commandes_pasfini ?></div>
            <div class="icon" style="margin-top:-35px;">
                <i class="bx bxs-cart-download cart four" style="background-color: #FCAEAE;color:#EE4E4E;padding:8px;font-size:21px;border-radius:12px"></i>
            </div>
        </div>
    </section>
    <section class="client">
        <div></div>
        <h4 style="margin-left: 10px;">Clients</h4>
        <ul class="top-sales-details">

            <?php
            foreach ($clients as $client) {
                echo "<li>";
                echo "<span class='price'> " . $client["nomClient"] . "</span>";
                echo "<a href='mailto:" . $client["emailClient"] . "'>";
                echo "<span style='color:#0d3073' class='product'> " . $client["emailClient"] . "</span>";
                echo "</a>";
                echo "</li>";
            }
            ?>

        </ul>


    </section>
    <section class="cmd">
        <div></div>
        <h4 style="margin-left: 10px;">Commandes non fini</h4>
        <div class="sales-details">
            <ul class="details">
                <li class="topic" style="color:#0d3073">Numéro</li>
                <?php
                foreach ($commandes as $commande) {
                    echo $commande["id"];
                    echo "<br/>";
                }
                ?>
            </ul>
            <ul class="details">
                <li class="topic" style="color:#0d3073">Quantité</li>
                <?php
                foreach ($commandes as $commande) {
                    echo $commande["quantity"];
                    echo "<br/>";
                }
                ?>
            </ul>
            <ul class="details">
                <li class="topic" style="color:#0d3073">Date de Commande</li>
                <?php
                foreach ($commandes as $commande) {
                    echo $commande["date_commande"];
                    echo "<br/>";
                }
                ?>
            </ul>
            <ul class="details">
                <li class="topic" style="color:#0d3073">Date de Livraison</li>
                <?php
                foreach ($commandes as $commande) {
                    echo $commande["date_livraison"];
                    echo "<br/>";
                }
                ?>
            </ul>
        </div>
        <br>
        <br><br><br><br>
        <br><br>
        <div class="voir">
            <a href="./commande.php">Voir Tout</a>
        </div>
        </div>
        </div>
        </div>

    </section>

</body>

</html>