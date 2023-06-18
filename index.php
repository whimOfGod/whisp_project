<?php 
session_start();
    //initialisation de la variable $order
    $order = '';
    //vérification de l'existence la variable dans l'URL 
        if (isset($_GET['order'])) {
            if ($_GET['order'] == 'asc') {
            // faire un Tri du plus ancien au plus récent
                $order = 'ORDER BY date ASC'; 
            } elseif ($_GET['order'] == 'desc') {
            // faire un Tri du plus récent au plus ancien
                $order = 'ORDER BY date DESC'; 
            }
        };
    // connexion à la base de donnée
    require "template/database.php";
    //ligne (17) préparation , ligne (18):exécution, ligne(20) récupérer tous les résultats sous forme d'un tableau associatif dans la variable
    $requete = $database->prepare(" SELECT * FROM whisps INNER JOIN users ON whisps.user_id = users.users_id $order");
    $requete->execute();
    //on définit une variable qui va stocker notre requête 
    $whisps = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>whisp</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c6879e030e.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Header -->
    <?php include 'template/header.php' ?>
    <!-- Index content -->
    <section class="d-flex px-3 py-2">
        <!-- Menu -->
        <nav class="w-25 pe-3" aria-label="Menu">
            <!-- Menu "Icon -->
            <figure class="cursor-pointer" id="open_menu" onclick="openMenu()">
                <img src="images/menu.svg" title="Ouvrir le menu" alt="Menu" class="w-40" />
            </figure>
            <!-- Open Menu -->
            <?php include 'template/nav.php' ?>  
        </nav>
        <!-- Main content -->
        <section class="w-50">
            <!-- Menu -->
            <ul class="d-flex justify-content-center list-unstyled mb-1" id="menu">
                <li class="cursor-pointer text-primary fw-bold border-end border-3 border-primary pe-3">Accueil</li>
                <li class="cursor-pointer text-primary fw-bold px-3 border-end border-3 border-primary">A propos</li>
                <li class="cursor-pointer text-primary fw-bold px-3 border-end border-3 border-primary">Confidentialité</li>
                <li class="cursor-pointer text-primary fw-bold px-3 border-end border-3 border-primary">S'inscrire</li>
                <li class="cursor-pointer text-primary fw-bold ps-3">Se connecter</li>
            </ul>
            <!-- Greeting -->
            <p class="fw-bold">
                Bonjour <span class="text-primary"><?php 
                //si la variable de session existe, afficher le pseudo de l'utilisateur
                if (isset($_SESSION['s_pseudo'])) {
                    echo $_SESSION['s_pseudo'];
                } else {
                    echo 'visiteur';
                }
               ?></span>
            </p>
            <!-- Publications -->
            <section class="border px-2 pt-2 pb-4 posts">
                <!-- Make a publication -->
                <form method="POST" action="template/publish_whisp.php" enctype="multipart/form-data">
                    <label class="d-flex bg-secondary-subtle p-1 w-full" >
                        <!-- Post message -->
                        <!-- lorsque l'utilisateur n'est pas connecté, il ne peut pas publier de message -->
                        <?php if (isset($_SESSION['s_pseudo'])) { ?>
                            <textarea   class="flex-grow-1 bg-secondary-subtle no-outline border-0"
                                        name="tweet"
                                        placeholder="Ecrivez quelque chose..."></textarea>
                            <!-- Add image button and tag -->
                            <figure class="d-flex flex-column">
                                <!-- Image -->
                                <i  class="fa-solid fa-image w-20 cursor-pointer icon-color-b" onclick="imageFile()">
                                    <input  type="file" 
                                            name="media" 
                                            id="image" 
                                            class="d-none" />
                                </i>
                            
                                <!-- Tag -->
                                <i class="fa-solid fa-tags w-20 pt-2 cursor-pointer icon-color-o" onclick="showTag()" ></i>
                            </figure>
          
                        <?php } else { ?>
                            <textarea   class="flex-grow-1 bg-secondary-subtle no-outline border-0 d-flex align-items-center justify-content-start"
                                        name="tweet"
                                        readonly>
                                        Vous devez être connecté pour publier un message
                            </textarea>
                                        
                                        
                        <?php } ?>
                       
                    </label>
                    <div class=" d-flex justify-content-space-between">
                                <!-- Add image button and tag -->
                                <select class="d-none no-outline border-0" name="tag" id="tag" >
                                        <option value="red">Rouge</option>
                                        <option value="blue">Bleu</option>
                                        <option value="green">Vert</option>
                                        <option value="violet">Violet</option>
                                    </select>
                                <button type="submit" class=" btn bg-primary ms-auto my-2 px-4 py-1 rounded-5 text-white">
                                    Publier
                                </button>
                                <div></div>
                            </div>

                </form>
                <!-- Flip publications up to down -->
                <figure class="border-top">
                    <i  class="fa-solid fa-arrow-down fa-xl cursor-pointer icon-color-b ?order=asc"> </i>
                    <i  class="fa-solid fa-arrow-up fa-xl cursor-pointer icon-color-b ?order=desc"> </i>
                    
                </figure>
                <!-- Publications -->
                <section>
                    <!-- Publication -->
                    <?php foreach ($whisps as $element) { ?>
                        <div    class="bg-secondary-subtle d-flex justify-content-center p-2">

                                <article class="w-75 bg-white rounded-4 px-3 py-2 ">
                                    <h3 class="text-primary fs-4 fw-bold">
                                        <?= $element['pseudo'] ?>
                                    </h3>
                                    <!-- content -->
                                    <p>
                                        <?= $element['tweet'] ?> 
                                    </p>
                                    <!-- Image -->
                                    <?php if ($element['media']) { ?>
                                        <figure class="border-top rounded cursor-pointer">
                                            <img src="images/<?= $element['media'] ?>" alt="image" class="w-100 h-80">
                                        </figure>
                                    <?php } ?>

                                    <!-- Delete and post date -->
                                    <form action="template/delete_whisp.php" method="POST">
                                        <div class="d-flex justify-content-between align-items-center">
                                        <button type="submit" class="border-0 bg-inherit">
                                            <i class="fa-solid fa-trash icon-color-r ">
                                                <input type="hidden" name="supp" value="<?= $element['whisps_id'] ?>">
                                            </i>
                                        </button>
                                            <span> <?= $element['date'] ?> </span>
                                        </div>
                                    </form>
                                </article>
                                
                        </div>

                    <?php } ?>
                                       
                </section>
            </section>
        </section>
        <!-- Message -->
        <?php include 'template/message.php' ?>
    </section>
    <!-- Footer -->
    <?php include 'template/footer.php' ?>

    <section >
        <?php 
            if (!isset($_SESSION['s_nom'])) {
                include 'login.php';
            }
        ?>
    </section>

    <script src="js/script.js"></script>
</body>
</html>