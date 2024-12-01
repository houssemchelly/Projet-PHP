<?php
    session_start();
    require 'connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $nom = $_POST['nom'];
        $mot_de_passe = (trim($_POST['mot_de_passe']));
    
        if (empty($nom) || empty($mot_de_passe)) {
            $_SESSION['error'] = "Tous les champs sont obligatoires.";
        } 
        else{
            $user = $bd->prepare("SELECT COUNT(*) FROM utilisateur WHERE mot_de_passe = ? and nom=?" );
            $user->execute([$mot_de_passe, $nom]);
            if ($user->fetchColumn() > 0) {
                $id=$bd->prepare("SELECT id FROM utilisateur WHERE mot_de_passe = ? and nom=?" );
                $b=$id->execute([$mot_de_passe, $nom]);
                $_SESSION['id'] = $b['id'];
                header("Location: index.php");
                exit;
            }
            else{
                $_SESSION['error'] = "verifier votre informations";
            }
        }
    }
?>
    
    

