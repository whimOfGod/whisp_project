<?php
    session_start();
    require "database.php";
        if (isset($_GET['research'])) {
            $query = $_GET['research'];
            $requete = $database->prepare("SELECT * FROM whisps INNER JOIN users ON whisps.user_id = users.users_id WHERE tweet LIKE :query ORDER BY date DESC");
            $requete->execute([
                ':query' => '%'.$query.'%'
            ]);
            $results = $requete->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }       
?>

<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recherche</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h2 class="titleResult" >Résultats de recherche pour "<?php echo $query; ?>"</h2>
        <?php if (count($results) > 0): ?>
            <?php foreach ($results as $element){  ?>
                <div class="newAdd" id="tweetSearch<?php echo $element['whisps_id']; ?>">
                        <h4><?php echo $element['pseudo']; ?></h4>
                        <p><?php echo $element['tweet']; ?></p>
                        <img src="../images" width="500" alt="media" <?php echo $element['media'] ?> >
                        <h6><?php echo $element['date']; ?></h6>
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="supp" value="<?php echo $element['whisps_id']; ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            <?php } ?>
    <?php else: ?>
        <p>Aucun tweet trouvé pour "<?php echo $query; ?>"</p>
    <?php endif; ?>
    <a href="../index.php">retournez à l'accueil</a>
    <?php if (count($results) > 0): ?>
        <script>
            // cette instruction doit rediriger vers le tweet
            window.location.hash = '#tweetSearch<?php echo $results[0]['whisps_id']; ?>';
        </script>
    <?php endif; ?>
</body>
</html>
