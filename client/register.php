<?php
session_start();
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = (trim($_POST['mot_de_passe']));

    if (empty($nom) || empty($email) || empty($mot_de_passe)) {
        $_SESSION['error'] = "Tous les champs sont obligatoires.";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "L'email est invalide.";
    }
    else{
        $user = $bd->prepare("SELECT COUNT(*) FROM utilisateur WHERE email = ?");
        $user->execute([$email]);
        if ($user->fetchColumn() > 0) {
            $_SESSION['error'] = "Un utilisateur avec cet email existe déjà.";
        }
        else{
            $user = $bd->prepare("INSERT INTO utilisateur (nom, email, mot_de_passe, type) VALUES (?, ?, ?, 'visiteur')");
            if ($user->execute([$nom, $email, $mot_de_passe])) {
                $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                header("Location: login.php");
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de l'inscription. Veuillez réessayer.";
            }
        }
    }
}
?>

