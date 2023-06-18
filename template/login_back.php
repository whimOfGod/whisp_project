<?php
session_start();
require "database.php";
// on procède à une vérification des champs du formulaire de connexion
if (isset($_POST['mail']) && isset($_POST['password'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    
    // cette requête récupère l'utilisateur correspondant aux identifiants fournis
    $query = $database->prepare("SELECT * FROM users WHERE mail = :mail AND my_password = :password");
    $query->execute([
        "mail" => $mail,
        "password" => $password
    ]);
    
    $user = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        // si la connexion réussie, on enrégistre les informations de l'utilisateur dans la session
        $_SESSION['test'] = $user['users_id'];
        $_SESSION['s_users_id'] = $user['users_id'];
        $_SESSION['s_nom'] = $user['nom'];
        $_SESSION['s_pseudo'] = $user['pseudo'];
        $_SESSION['s_mail'] = $user['mail'];
        $_SESSION['s_password'] = $user['my_password'];

        // puis en redirige vers la page d'accueil après la connexion
        header("Location: ../index.php");
        exit();
    } else {
        // si les identifiants sont invalides, on affiche un message d'erreur
        echo "Identifiants invalides";
        header("Location: ../login.php");
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>