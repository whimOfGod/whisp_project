<?php 

    try {
        //  on établit une connexion à la base de données MySQL en utilisant PDO
        $database = new PDO(
            "mysql:host=localhost;dbname=whisp_db",
            "root",
            ""
        );
    }   catch(PDOException $error) {
        die($error);
    }
?>