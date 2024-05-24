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

$id = @$_GET["id"];
$stmt = $conn->prepare("SELECT * FROM achats WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    header("Location: achat.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM fournisseurs WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $row["id_fournisseur"]);
$stmt->execute();
$result = $stmt->get_result();
$fournisseur = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./styles/style.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #eee;
            font-family: "Rubik", sans-serif;
        }
        table.customTable {
            width: 100%;
            background-color: #FFFFFF;
            border-collapse: collapse;
            border-width: 2px;
            border-color: #0a2558;
            border-style: solid;
            color: #000000;
        }
        table.customTable thead {
            color: white;
            background-color: #0a2558;
        }
        table.customTable td, table.customTable th {
            border-width: 2px;
            border-color: #081d45;
            border-style: solid;
            padding: 5px;
        }
        .page {
            width: 21cm;
            min-height: 60%;
            padding: 1.4cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        @media print {
            body, .page {
                margin: 0;
                box-shadow: 0;
            }
            .center button {
                display: none;
            }
        }
        .page h5 {
            font-weight: 400;
        }
        .row {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page h2 {
            width: 100%;
            font-weight: 500;
            margin-top: 50px;
            text-align: center;
        }
        .page h3 {
            font-weight: 400;
        }
        .center {
            width: 100%;
            text-align: center;
        }
        .center button {
            border-radius: 5px;
            padding: 10px;
            color: white;
            cursor: pointer;
            background-color: #081d45;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <section><br>  
        <div class="center">
            <button id="btnPrint">Imprimer <i class="bx bx-printer"></i></button>
        </div>
        <div id="page" class="page">
            <div class="row">
                <div class="left">
                    <img src="./img/sinmatexlogo.png" width="250" alt=""><br>
                    <h5>R.P.7 Lot №15, Zone Industrielle, Berrechid, Morocco</h5>
                    <h5>(+212) 522 33 63 40/41/42</h5>
                </div>
                <div class="right">
                    <h5>Reçu N° #: <?php echo $row["id"]; ?></h5>
                    <h5>Date : <?php echo $row["date_achat"] ?></h5>
                </div>
            </div>
            <h2>DEMANDE ACHAT</h2><br>
            <table class="customTable">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Désignation</th>
                        <th>Code</th>
                        <th>Quantity</th>
                        <th>Fournisseur</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row["service"]; ?></td>
                        <td><?php echo $row["designation"]; ?></td>
                        <td><?php echo $row["code"]; ?></td>
                        <td><?php echo $row["quantite"]; ?></td>
                        <td><?php echo $fournisseur["nomFournisseur"]; ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div style="margin-top:25px" class="row">
                <h3>Demandeur</h3>
                <h3>Direction</h3>
                <h3>Achats</h3>
            </div>
        </div>
    </section>

    <script>
        document.getElementById("btnPrint").addEventListener("click", function () {
            window.print();
        });
    </script>
</body>
</html>
