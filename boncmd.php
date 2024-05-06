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
       .main input[type="button"]{
       display: block;
       margin-bottom: 30px;
       width: 680px;
       height: 25px;
       border-radius: 8px;
       border: 1px solid gray;
       }
       .main input[type="button"]{
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
       

       .taille input[type="text"] {
            display: inline-block;
            width: 140px; /* Adjust the width as needed */
            margin-right: 10px; /* Adjust the margin as needed */
            border-radius: 8px;
        }
        
        .taille label{
           margin-bottom: 50px;
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
                <li><a href=""><i class='bx bx-box'></i>Commandes</a></li>
                <li><a href=""><i class='bx bxs-pie-chart-alt' style='color:#ffffff'></i>Fournisseurs</a></li>
                <li><a href=""><i class='bx bxs-cylinder' style='color:#ffffff'></i>Achats</a></li>
                <li><a href=""><i class='bx bxs-t-shirt'></i>Tous les articles</a></li>
                <div style="margin-top: 220px;"></div>
                <li><a href="logout.php"><i class='bx bx-log-out'></i>Déconnexion</a></li>
            </ul>
        </div>
        <div class="main">
            <h2>Bon de Commande</h2>
          <form action="" class="form">
            <label for="">Article ref:</label>
             <input type="text" name="ref">
             <label for="">Nom de client:</label>
             <input type="text" name="client">
             <label for="">Nom d'article:</label>
             <input type="text" name="nom">
             
             <div class="taille">
                <label for="">taille S:</label>
             <input type="text" name="s">
             <label for="">taille M:</label>
             <input type="text" name="m">
             <label for="">taille L:</label>
             <input type="text" name="l">
             <label for="">taille X:</label>
             <input type="text" name="x">
             <label for="">taille XL:</label>
             <input type="text" name="xl">
             <label for="">taille 2XL:</label>
             <input type="text" name="2xl">
             <label for="">taille 3XL:</label>
             <input type="text" name="3xl">
             </div>
             <label for="">Date de commande:</label>
             <input type="date" name="comande">
             <label for="">Data de livraison:</label>
             <input type="date" name="livraisin"> 
             <input type="button" value="Crée commande">
          </form>
        </div>
    </div>

    

</body>

</html>