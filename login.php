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
function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

// Function to verify hashed password
function verifyPassword($password, $hashedPassword)
{
    return password_verify($password, $hashedPassword);
}

// Login process
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}
    // Query to check if username and password exist
    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Login successful, start session and redirect to admin dashboard
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location:dashboard.php');
        exit;
    } else {
       $errorMsg = "Invalid username or password";
}

$conn->close();
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.google.com/specimen/Rubik" rel="stylesheet">
    <title>sinmatex</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            

        }


        .page {
            background-image: url('img/sin.jpg');
            background-repeat: no-repeat;
            background-size: cover;

        }

        .form {
            width: 400px;
            height: 300px;
            border: 1px solid transparent;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff;

            margin-left: 450px;
            margin-top: 180px;
            padding-top: 30px;
            padding-bottom: 30px;
            padding-left: 10px;
            padding-right: 10px;
        }

        #boutton {
            width: 200px;
            height: 30px;
            border-radius: 20px;
            background-color: #39A7FF;
            color: #fff;
            border: none;
            margin-top: 10px;
            cursor: pointer;
        }

        .input-container {
            position: relative;
            margin: 20px;
        }

        .input-container input {
            width: 300px;
            border: none;
            border-bottom: 2px solid #39A7FF;
            background-color: transparent;
            padding: 5px;
            font-size: 16px;
            transition: border-bottom 0.3s ease;
            /* Apply transition to border-bottom */
            outline: none;
            /* Remove default outline when input is clicked */
        }

        .input-container label {
            position: absolute;
            left: 5px;
            top: 8px;
            color: #aaa;
            font-size: 16px;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .input-container input:focus+label,
        .input-container input:valid+label {
            top: -12px;
            font-size: 12px;
            color: #39A7FF;
        }

        label {
            font-size: 18px;
        }

        #titre {
            font-size: 25px;
            font-weight: 600;
            border: none;
            border-bottom: 1px solid #eee;
            width: 400px;
            text-align: center;
            font-family: 'Rubik', sans-serif;

        }
    </style>
</head>

<body>
    <div class="page"></div>
    <form class="form" action="login.php" method="post">
        <p id="titre">Login</p>
        <div class="input-container">
            <input type="text" id="username" name="username" required>
            <label for="username">Username</label>
        </div>
        <div class="input-container">
            <input type="password" id="password" name="password" required>
            <label for="password">Password</label>
        </div>
        <button type="submit" id="boutton">Login</button>
    </form>
    <script>
        const inputContainers = document.querySelectorAll('.input-container');

        inputContainers.forEach(container => {
            const input = container.querySelector('input');
            input.addEventListener('focus', () => {
                container.classList.add('focus');
            });
            input.addEventListener('blur', () => {
                if (input.value === '') {
                    container.classList.remove('focus');
                }
            });
        });
    </script>
</body>

</html>