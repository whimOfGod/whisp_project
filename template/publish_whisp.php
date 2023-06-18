<?php
session_start();
require "database.php";

// On Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['s_users_id'])) {
    header("Location: ../index.php");
    exit();
}

// On Vérifie si un fichier a été envoyé
if (isset($_FILES['media']) && $_FILES['media']['error'] === UPLOAD_ERR_OK) {
    $media = $_FILES['media']['name'];
    $media_tmp = $_FILES['media']['tmp_name'];

    // seulement les fichiers en .jpg, .jpeg, .png et .gif sont acceptés
    $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
    $extension = strtolower(pathinfo($media, PATHINFO_EXTENSION));
    // On vérifie si l'extension du fichier envoyé est dans le tableau des extensions autorisées
    if (!in_array($extension, $allowed_extensions)) {
        echo "Le fichier n'est pas une image valide.";
        exit();
    }
// On vérifie si le fichier ne dépasse pas 10Mo
if ($_FILES['media']['size'] > 10000000) {
    echo "<script>alert('Le fichier ne doit pas dépasser 10Mo.');</script>";
    echo "<script>window.location.href = '../index.php';</script>";
    exit();
}


    // On Spécifie le chemin complet vers le dossier "images"
    $destination = "../images/" . $media;

    // On déplace le fichier vers le dossier "images"
    if (!move_uploaded_file($media_tmp, $destination)) {
        echo "Une erreur s'est produite lors de l'enregistrement du fichier.";
        exit();
    }
} else {
    $media = null;
}

// Insertion du whisp dans la table whisps
$insert = $database->prepare("INSERT INTO whisps (whisps_id, tweet, user_id, media) VALUES (null, :tweet, :user_id, :media)");
$insert->execute([
    "tweet" => $_POST['tweet'],
    "user_id" => $_SESSION['s_users_id'],
    "media" => $media
]);

header("Location: ../index.php");
?>
