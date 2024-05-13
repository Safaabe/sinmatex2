







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
                <li><a href="article.php"><i class='bx bxs-t-shirt'></i>Tous les articles</a></li>
                <div style="margin-top: 220px;"></div>
                <li><a href="logout.php"><i class='bx bx-log-out'></i>Déconnexion</a></li>
            </ul>
        </div>
       
<div class="bon">
    <h4 style="font-size: 23px;">Bon d'achat</h4>
    <form action="nvcommande.php"  method="get">
    <label for="">Ref d'article:</label>
    <input type="text" name="ref">
    <input type="submit" value="crée commande">
    </form>
</div>
    
    </div>
</body>

</html>