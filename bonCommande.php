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

$id = @$_GET["numcommande"];
$stmt = $conn->prepare("SELECT * FROM commandes WHERE id=? LIMIT 1"); 
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    header("Location: commande.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM clients WHERE id=? LIMIT 1"); 
$stmt->bind_param("i", $row["id_client"]);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM articles WHERE id=? LIMIT 1"); 
$stmt->bind_param("i", $row["articleRef"]);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <style>
        table.customTable {
  width: 100%;
  background-color: #FFFFFF;
  border-collapse: collapse;
  border-width: 2px;
  border-color: #0a2558;
  border-style: solid;
  color: #000000;
}
table.customTable thead{
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
  background:   white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
.page h5{
  font-weight: 400;
}
.row{
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.page  h2{
  width: 100%;
  font-weight: 500;
  margin-top: 50px;
  text-align: center;
}
.page h3{
  font-weight: 400;
}
.center{
  width: 100%;
  text-align: center;
}
.center button{
  border-radius: 5px;
  padding: 10px;
  color: white;
  cursor: pointer;
   background-color: #081d45;
}
@media print {
  .myDivToPrint {
      background-color: white;
      height: 100%;
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
      margin: 0;
      padding: 15px;
      font-size: 14px;
      line-height: 18px;
  }
}

.row_inputs{
  width: 100%;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  align-items: flex-start;
}
    </style>
    <link rel="stylesheet" href="./styles/style.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body >
  <section ><br>  
    <div class="center">
    <button id="btnPrint">Imprimer <i class="bx bx-printer"></i></button>
    </div>
     <div id="page" class="page">
        <div class="row">
        <div class="left">
        <img src="./img/sinmatexlogo.png" width="250" alt=""><br>
        <h5>
R.P.7 Lot №15, Zone Industrielle, Berrechid, Morocco</h5>
<h5>(+212) 522 33 63 40/41/42</h5>
     </div>
     <div class="right">
     <h5>Reçu N° #: <?php echo $row["id"]; ?></h5>
     <h5>Date : <?php echo $row["date_commande"] ?></h5>
     <h5>Récepteur : <?php echo $client["nomClient"] ?></h5>
     </div>
        </div>
        <h2>Bon de Commande  NO: <?php echo $row["id"]; ?></h2><br>
        <table class="customTable">
  <thead>
    <tr>
      <th>Client</th>
      <th>Nom Article</th>
      <th>Réf</th>
      <th>Date Commande</th>
      <th>Date Livraison</th>

    </tr>
  </thead>
  <tbody>
   <tr>
    <td><?php echo $client["nomClient"]; ?></td>
    <td><?php echo $article["nom_article"]; ?></td>
    <td><?php echo $row["id"]; ?></td>
    <td><?php echo $row["date_commande"]; ?></td>
    <td><?php echo $row["date_livraison"]; ?></td>
   </tr>
  </tbody>
</table><br>
<br>
<p id="para">GXXBX <?php echo $article["desc_article"]; ?></p><br><br>
<table class="customTable">
  <thead>
    <tr>
      <th>Taille S</th>
      <th>Taille M</th>
      <th>Taille L</th>
      <th>Taille X</th>
      <th>Taille XL</th>
      <th>Taille 2XL</th>
      <th>Taille 3XL</th>
      <th>TOT QTE</th>

    </tr>
  </thead>
  <tbody>
   <tr>
    <td><?php echo $row["taille_s"]; ?></td>
    <td><?php echo $row["taille_m"]; ?></td>
    <td><?php echo $row["taille_l"]; ?></td>
    <td><?php echo $row["taille_x"]; ?></td>
    <td><?php echo $row["taille_xl"]; ?></td>
    <td><?php echo $row["taille_2xl"]; ?></td>
    <td><?php echo $row["taille_3xl"]; ?></td>
    <td><?php echo $row["quantity"]; ?></td>

   </tr>
  </tbody>
</table>
<div style="margin-top:25px" class="row">
    <h3>Atelier Destinataire</h3>
    <h3>Direction</h3>
    <h3>Client</h3>

</div>
     </div>
    </section>
   

    <script>
      let btn = document.querySelector("#btnPrint");
      btn.addEventListener("click",()=> {
          btn.style.display = "none";
          window.print();
          btn.style.display = null;
          
      });
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };
    </script>
  </body>
</html>
