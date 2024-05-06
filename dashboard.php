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

        .cartes {
            display: flex;
            flex-direction: row;
            margin-left: 250px;
            margin-top: 90px;
            margin-bottom: 20px;

        }

        .card {
            border: 1px solid transparent;
            border-radius: 10px;
            padding: 20px;
            margin-right: 10px;
            height: 80px;
            width: 250px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);


        }

        .card h4 {
            position: absolute;
            top: 150px
        }

        .client {
            border: 1px solid transparent;
            border-radius: 15px;
            width: 430px;
            height: 300px;
            background-color: #fff;
            margin-left: 250px;
            margin-top: 30px;



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
        </div>
        <div class="card">
            <h4>Clients</h4>
        </div>
        <div class="card">
            <h4>Articles</h4>
        </div>
        <div class="card">
            <h4>Commandes <br>non fini</h4>
        </div>
    </section>
    <section class="client">
        <div></div>
        <h4 style="margin-left: 10px;">Clients</h4>


    </section>
    <section class="cmd">
        <div></div>
        <h4 style="margin-left: 10px;">Commandes non fini</h4>


    </section>

</body>

</html>