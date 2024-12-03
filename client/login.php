<?php
    session_start();
    require '../connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $nom = $_POST['nom'];
        $mot_de_passe = trim($_POST['mot_de_passe']);
    
        if (empty($nom) || empty($mot_de_passe)) {
            $_SESSION['error'] = "Tous les champs sont obligatoires.";
        } else {
            $user = $bd->prepare("SELECT COUNT(*) FROM utilisateur WHERE mot_de_passe = ? AND nom = ?");
            $user->execute([$mot_de_passe, $nom]);
            if ($user->fetchColumn() > 0) {
                $idQuery = $bd->prepare("SELECT id FROM utilisateur WHERE mot_de_passe = ? AND nom = ?");
                $idQuery->execute([$mot_de_passe, $nom]);
                $userData = $idQuery->fetch(PDO::FETCH_ASSOC);
                if ($userData) {
                    $_SESSION['id'] = $userData['id'];
                    header("Location: index.php?user=" . $nom."&id=".$userData['id']);
                    exit;
                }
            } else {
                $_SESSION['error'] = "Vérifiez vos informations.";
            }
        }
    }
?>
