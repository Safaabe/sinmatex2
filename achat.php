<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'sinmatexdb';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

$query_fournisseurs = $conn->prepare("SELECT * FROM `fournisseurs` ");
$query_fournisseurs->execute();
$result_fournisseurs = $query_fournisseurs->get_result(); // Get the result set
$fournisseurs = $result_fournisseurs->fetch_all(MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $designation = $_POST['designation'];
    $code = $_POST['code'];
    $id_fournisseur = $_POST['id'];
    $quantite = $_POST['quantite'];
    $service = $_POST['service'];

    // Inserting data into database
    $query_insert = $conn->prepare("INSERT INTO achats (designation, code, id_fournisseur, quantite, service, date_achat) VALUES (?, ?, ?, ?, ?, NOW())");

    // Bind parameters
    $query_insert->bind_param("ssiis", $designation, $code, $id_fournisseur, $quantite, $service);

    // Execute the query
    if ($query_insert->execute()) {
        // Redirect to the same page after successful insertion
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $query_insert->error;
    }
}
$query_achats = "SELECT * FROM achats";
$result_achats = $conn->query($query_achats);

$achats_data = [];
if ($result_achats->num_rows > 0) {
    while ($row = $result_achats->fetch_assoc()) {
        $achats_data[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>achats</title>
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
            margin-left: 220px;
            margin-top: 70px;
            width: 430px;
            padding-top: 20px;
            height: 500px;

        }

        .form input[type="text"]
       {
            width: 250px;
            padding: 10px;
            margin-bottom: 10px;
            display: block;
            margin-left: 40px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid gray;
            border-radius: 5px;
            height: 5px;
        }
        
        .form select {
            display: block;
           margin-top: 10px;
            margin-left: 38px;
            width: 280px;
            height: 27px;
            border-radius: 8px;
            border: 1px solid gray;
        }

        label {
            font-size: 15px;
            margin-left: 50px;
            font-weight: bold;

        }

        .cli {
            border: 1px solid transparent;
            border-radius: 15px;
            box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1);
            margin-left: 700px;
            margin-top: -520px;
            width: 630px;
            height: 400px;
            background-color: #fff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th
        {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            color: #fff;
            padding: 2px;
            height: 20px;
            font-size: 15px;
            font-weight: 400;
        }
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            color: #000;
        }


        th {
            background-color: #102C57;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="margin-left: 220px;font-size:17px;margin-top:15px;color:#102C57;">Achats</h2>
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
            <h3 style="margin-left:30px;margin-bottom:30px;font-size:24px; font-family: 'PT Sans', sans-serif;">Demande d'achat</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="">Designation:</label>
                <input type="text" name="designation" >
                <label for="">code:</label>
                <input type="text" name="code" >
                <label for="">Fournisseur:</label><br>
                <select name="id">
                    <?php
                    foreach ($fournisseurs as $fournisseur) {
                        echo '<option value="' . $fournisseur["id"] . '">' . $fournisseur["nomFournisseur"] . '</option>';
                    }
                    ?>
                </select> <br>               
                <label for="">Quantité:</label>
                <input type="text" name="quantite" >
                <label for="">Service</label>
                <input type="text" name="service">
                <input type="submit" name="ajouter" value="Ajouter" style="background-color: #102C57;color:#fff;font-size:16px;border:none;margin-left:50px;height:26px;border-radius:5px;width:250px">
            </form>
        </div>
        <div class="cli">
            <h3 style="margin-left:30px;margin-bottom:20px;font-size:24px; font-family: 'PT Sans', sans-serif;">Liste des Achats</h3>
            <table>
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Designation</th>
                        <th>Code</th>
                        <th>Fournisseur</th>
                        <th>Quantité</th>
                        <th>Service</th>
                        <th>Date d'Achat</th>
                        <th>Modifier</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($achats_data as $achat) : ?>
                        <tr>
                            <td>N°<?php echo $achat['id']; ?></td>
                            <td><?php echo $achat['designation']; ?></td>
                            <td><?php echo $achat['code']; ?></td>
                            <td>
                        <?php 
                       
                        $id_fournisseur = $fournisseur['id'];
                        $nomFournisseur = '';
                        foreach ($fournisseurs as $fournisseur) {
                            if ($fournisseur['id'] == $id_fournisseur) {
                                $nomFournisseur = $fournisseur['nomFournisseur'];
                                break;
                            }
                        }
                        echo $nomFournisseur;
                        ?>
                    </td>
                            <td><?php echo $achat['quantite']; ?></td>
                            <td><?php echo $achat['service']; ?></td>
                            <td><?php echo $achat['date_achat']; ?></td>
                            <td style="width: 20px;">
    <a href="bon_achat.php?id=<?php echo $achat['id']; ?>">
        <i style="font-size: 20px;color:#2697ff !important" class="bx bx-printer"></i>
    </a>
    <a href="./supp_achat.php?ref=<?php echo $achat['id']; ?>">
        <i style="font-size: 20px;color: #FF0000 !important" class="bx bx-trash"></i>
    </a>
</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        </div>
    </div>
</body>
</html>