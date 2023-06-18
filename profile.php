<?php
session_start();
require "template/database.php";
    $requete = $database->prepare("SELECT * FROM users WHERE users_id = :users_id");
    $requete->execute([
        "users_id" => $_SESSION['s_users_id']
    ]);
    $user = $requete->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
</head>
<body>
    <?php include "template/header.php"; ?>
        <h1>Profile</h1>
        <section class="d-flex px-3 py-2">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <img src="images/<?= $user['avatar'] ?>" alt="avatar" class="rounded-circle" width="150">
                <h2 class="text-primary"><?= $user['pseudo'] ?></h2>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <p class="text-primary">Email : <?= $user['email'] ?></p>
                <p class="text-primary">Nom & prénom : <?= $user['nom'] ?></p>
                <p class="text-primary">Ville : <?= $user['pseudo'] ?></p>
                <p class="text-primary">Inscription : <?= $user['mail'] ?></p>
            </div>
        </section>
    <?php include "template/footer.php"; ?>
</body>
</html>