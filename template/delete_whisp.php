<?php
session_start();
require "database.php";

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['s_users_id'])) {
    $user_id = $_SESSION['s_users_id'];

    // Récupérer le chemin du fichier à supprimer et vérifier si l'utilisateur est le propriétaire du whisp
    $fetchWhisp = $database->prepare("SELECT media, user_id FROM whisps WHERE whisps_id = :whisps_id");
    $fetchWhisp->execute([
        "whisps_id" => $_POST['supp'],
    ]);
    $whisp = $fetchWhisp->fetch(PDO::FETCH_ASSOC);

    if ($whisp && $whisp['user_id'] == $user_id) {
        $mediaPath = $whisp['media'];

        // Supprimer l'enregistrement de la base de données
        $deleteWhisp = $database->prepare("DELETE FROM whisps WHERE whisps_id = :whisps_id");
        $deleteWhisp->execute([
            "whisps_id" => $_POST['supp'],
        ]);

        // Suppression le fichier média du dossier
        if (!empty($mediaPath)) {
            $filePath = '../images' . $mediaPath; 
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}

header("Location: ../index.php");
?>