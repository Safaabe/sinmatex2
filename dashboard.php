<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.0.7/css/boxicons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Rubik", sans-serif; /* Applying Rubik font to all elements */
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
            width: 170px;
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
            font-size:15px ;
        }
        ul li i{
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="header"></div>

    <div class="sidebar">
        <div class="logo"><img src="img/sinmatexlogo.png" alt="simatex"></div>
        <ul>
            <li><a href=""><i class='bx bx-line-chart' style='color:#ffffff' ></i> Dashboard</a></li>
            <li><a href=""><i class='bx bxs-group' style='color:#ffffff' ></i>Clients</a></li>
            <li><a href=""><i class='bx bx-box'></i>Commandes</a></li>
            <li><a href=""><i class='bx bxs-pie-chart-alt' style='color:#ffffff' ></i>Fournisseurs</a></li>
            <li><a href=""><i class='bx bxs-cylinder' style='color:#ffffff' ></i>Achats</a></li>
            <li><a href=""><i class='bx bxs-t-shirt'></i>Tous les articles</a></li>
        </ul>
    </div>

</body>

</html>
