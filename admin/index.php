<?php 
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../client/login1.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des commandes</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        #header {
            text-align: center;
            margin-bottom: 20px;
        }
        #header a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
        }
        #header a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        #content {
            margin-top: 20px;
        }
        #centerCol {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div id="header" class="col-12">
                <a href="animal/liste_animals.php">Liste animal General</a>
                <a href="sous_animal/liste_sous_animal.php">Liste animaux</a>
                <a href="../client/logout.php">Logout</a>
            </div>
        </div>

        <div id="content" class="row">
            <div id="centerCol" class="col-10 offset-1">
                <!-- Contenu à ajouter ici -->
            </div>
        </div>
    </div>

</body>

</html>
