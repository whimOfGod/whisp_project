<?php
session_start();
require "database.php";

$verify = $database->prepare("SELECT * FROM users WHERE mail = :mail");
$verify->execute(["mail" => $_POST['mail']]);
$verifyCondition = $verify->fetchAll(PDO::FETCH_ASSOC);

if ($verifyCondition == false) {
    // on vérifie si un fichier avatar a été envoyé
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $avatar = $_FILES['avatar']['name'];
        $avatar_tmp = $_FILES['avatar']['tmp_name'];

        // déplacement du fichier vers le dossier de stockage 
        move_uploaded_file($avatar_tmp, "../images/avatar/" . $avatar);
    } else {
        $avatar = null;
    }

    // Hachage du mot de passe
    $password = $_POST['my_password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insert = $database->prepare("INSERT INTO users (nom, pseudo, mail, my_password, avatar) VALUES (:myName, :myPseudo, :myMail, :myPassword, :avatar)");
    $insert->execute([
        "myName" => $_POST['nom'],
        "myPseudo" => $_POST['pseudo'],
        "myMail" => $_POST['mail'],
        "myPassword" => $hashedPassword,
        "avatar" => $avatar
    ]);

    $select = $database->prepare("SELECT * FROM users WHERE mail = :mail");
    $select->execute(["mail" => $_POST['mail']]);
    $account = $select->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['s_users_id'] = $account[0]['users_id'];
    $_SESSION['s_nom'] = $account[0]['nom'];
    $_SESSION['s_pseudo'] = $account[0]['pseudo'];
    $_SESSION['s_mail'] = $account[0]['mail'];
    $_SESSION['s_password'] = $account[0]['my_password'];
    $_SESSION['s_avatar'] = $account[0]['avatar'];

    // Redirection vers la page d'accueil
    header("Location: ../index.php");
} else {
    echo "Ce compte existe déjà";
}
?>