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
//ajouter 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $adress = $_POST["adress"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];

    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO clients (nomClient, adressClient, emailClient, telClient) VALUES (?, ?, ?, ?)");

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssss", $nom, $adress, $email, $tel);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Client ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du client: " . $conn->error;
    }
}
// Retrieve data from the clients table
$stmt = $conn->prepare("SELECT * FROM clients");
$stmt->execute();
$clients = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.0.7/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
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
            border: 1px solid transparent;
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1);
            margin-left: 250px;
            margin-top: 80px;
            width: 430px;
            padding-top: 20px;
            height: 500px;
           
        }

        .form input[type="text"],
        .form input[type="submit"] {
            width: 250px;
            padding: 10px;
            margin-bottom: 10px;
            display: block;
            margin-left: 40px;
            margin-top:10px ;
            margin-bottom: 20px;
            border: 1px solid black;
            border-radius: 15px;
        } 
        label{
            font-size: 15px;
            margin-left: 50px;
            font-weight: bold;
           
        } 
        .cli{
            border: 1px solid transparent;
            border-radius: 15px;
            box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1);
            margin-left: 700px;
            margin-top:-520px;
            width: 630px;
            height: 500px;
            background-color: #fff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #102C57;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin-left: 220px;font-size:17px;margin-top:15px;color:#102C57;">Clients</h2>
        </div>

        <div class="sidebar">
            <div class="logo"><img src="img/sinmatex.png" alt="simatex"></div>
            <ul>
                <li><a href="dashboard.php"><i class='bx bx-line-chart' style='color:#ffffff'></i> Dashboard</a></li>
                <li><a href="client.php"><i class='bx bxs-group' style='color:#ffffff'></i>Clients</a></li>
                <li><a href="commande.php"><i class='bx bx-box'></i>Commandes</a></li>
                <li><a href=""><i class='bx bxs-pie-chart-alt' style='color:#ffffff'></i>Fournisseurs</a></li>
                <li><a href=""><i class='bx bxs-cylinder' style='color:#ffffff'></i>Achats</a></li>
                <li><a href=""><i class='bx bxs-t-shirt'></i>Tous les articles</a></li>
                <div style="margin-top: 220px;"></div>
                <li><a href="logout.php"><i class='bx bx-log-out'></i>Déconnexion</a></li>
            </ul>
        </div>

        <div class="form">
            <h3 style="margin-left:30px;margin-bottom:30px;font-size:24px; font-family: 'PT Sans', sans-serif;">Ajouter un client</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="">Nom clients:</label>
                <input type="text" name="nom" placeholder="Nom">
                <label for="">Adress clients:</label>
                <input type="text" name="adress" placeholder="Adresse">
                <label for="">Email clients:</label>
                <input type="text" name="email" placeholder="Email">
                <label for="">Téléphone clients:</label>
                <input type="text" name="tel" placeholder="Téléphone">
                <input type="submit" name="ajouter" value="Ajouter" style="background-color: #102C57;color:#fff;font-size:16px;border:none;margin-left:50px">
            </form>
        </div>

        <div class="cli">
            <h2 style="margin-left:30px;margin-bottom:30px;font-size:24px; font-family: 'PT Sans', sans-serif;">Nos clients</h2>
            <table>
        <thead>
            <tr>
                <th style="color: #fff;">Nom</th>
                <th style="color: #fff;">Adresse</th>
                <th style="color: #fff;">Email</th>
                <th style="color: #fff;">Téléphone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client) {?>
            <tr>
                <td><?= $client['nomClient']?></td>
                <td><?= $client['adressClient']?></td>
                <td><?= $client['emailClient']?></td>
                <td><?= $client['telClient']?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
        </div>
    </div>
</body>
</html>
