







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
        label {
            font-size: 15px;
            margin-left: 0px;
          
            padding-bottom: 20px;
            font-weight: 600;

        }
        .bon{
            margin-left: 220px;
            margin-top: 82px;
            width: 250px;
            padding: 20px;
            border: 1px solid transparent;
            box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            background-color: #fff;
            height: 200px;
        }
        .bon input[type="text"]
         {
            width: 180px;
            padding: 7px;
            margin-bottom: 20px;
            display: block;
            border: 1px solid black;
            border-radius: 10px;
        }
        .bon input[type="submit"] {
            width: 198px;
            padding: 10px;
            margin-bottom: 10px;
            display: block;
            border: 1px solid #eee;
            border-radius: 12px;
            background-color: #102C57;
            color: #fff;
            font-size: 15px;
            margin-top: 10px;
            

        }
        .customTable {
    width: 95%; /* Adjust the width as needed */
    max-width: 800px; /* Set a maximum width */
    margin-left: 10px; /* Center the table horizontally */
    margin-right: auto;
    background-color: #FFFFFF;
    border-collapse: collapse;
    border-width: 2px;
    border-color: #0a2558;
    border-style: solid;
    color: #000000;
    margin-top: 30px;
    flex: 1;
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
.main{
    display: flex;
    flex-direction: row;
}
.commande{
    border:1px solid transparent;
    box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    border-radius: 15px;
    margin-left: 50px;
    margin-top: 90px;
    display: flex; /* Use flexbox */
    flex-direction: column;
    padding: 20px;
}
.search-box {
    position: relative;
  height: 50px;
  max-width: 550px;
  width: 100%;
  margin: -35px 960px;
        }
        .search-box input {
            border-radius: 5px;
            width: 300px;
            height: 16px;
            border: 1px solid #000;
            outline: none;
           
        }
         .search-box button {
            height: 25px;
            background-color: #081d45;
            color: #fff;
            font-size: 15px;
            border: none;
            border-radius: 5px;
            
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="margin-left: 220px;font-size:17px;margin-top:15px;color:#102C57;">Commandes</h2>
            <div class="search-box">
         <form action="chercher.php" method="get">
         <input style="padding:5px" type="text" name="ref" placeholder="Recherche..." />
         <button style="cursor:pointer" type="submit"><i class="bx bx-search"></i></button>
         </form>
        </div>
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
        <div class="bon">
    <h4 style="font-size: 23px;">Bon d'achat</h4>
    <form action="nvcommande.php"  method="get">
    <label for="">Ref d'article:</label>
    <input type="text" name="ref">
    <input type="submit" value="crée commande">
    </form>
    </div>
    <div class="commande">
    <div style="margin-left: 10px; margin-top:10px; font-size:20px;font-weight:600 ;">Commandes</div>
    <table class="customTable">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Client</th>
                <th>Article</th>
                <th>Date Commande</th>
                <th>Date Livraison</th>
                <th>Quantité</th>
                <th>Statut</th>
                <th>Reçu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            

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
                // Fetching data from the commandes table
                $query = $conn->prepare("SELECT * FROM commandes");
                $query->execute();
                $result = $query->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>N°". $row["id"] . "</td>";
                    // Fetching client information
                    $stmt = $conn->prepare("SELECT * FROM clients WHERE id=? LIMIT 1"); 
                    $stmt->bind_param("i", $row["id_client"]);
                    $stmt->execute(); 
                    $client = $stmt->get_result()->fetch_assoc();
                    echo "<td>". $client["nomClient"] . "</td>";
                    // Fetching article information
                    $stmt = $conn->prepare("SELECT * FROM articles WHERE id=? LIMIT 1"); 
                    $stmt->bind_param("i", $row["articleRef"]); 
                    $stmt->execute(); 
                    $article = $stmt->get_result()->fetch_assoc();
                    echo '<td><img width="60" src="'.$article["image_article"].'"/></td>';
                    echo "<td>". $row["date_commande"] . "</td>";
                    echo "<td>". $row["date_livraison"] . "</td>";
                    echo "<td>". $row["quantity"] . "</td>";
                    if($row["fini"] == 1){
                        echo "<td>fini</td>";
                        echo '<td><a href="./bonCommande.php?numcommande=' .$row["id"]   .'">  <i style="font-size:20px;color:#2697ff !important" class="bx bx-printer"></i></td>';
                    } else {
                        echo "<td>pas fini</td>";
                        echo '<td><a href="./bon_commande.php?numcommande=' .$row["id"]   .'">  <i style="font-size:20px;color:#2697ff !important" class="bx bx-printer"></i></a><a href="./fini_commande.php?ref='.$row["id"].'"><i style="font-size:20px;color:#008000 !important" class="bx bx-check-circle"></i></a></td>';
                    }
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>
       </div>

    </div>
</body>

</html>