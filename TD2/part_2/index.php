<?php
    define('root_dir',__DIR__);
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./assets/uploadPreview.css">
        <title>Connexion</title>
    </head>
    <body>
    <div id="container">
        <ul class="crumb1">
            <li><a href="#Connexion">Connexion</a></li>
        </ul>
        <form action="./controllers/index_controller.php" method="POST">
            <div class="center">
                <label>
                    <b>Nom d'utilisateur</b>
                </label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
                <label>
                    <b>Mot de passe</b>
                </label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
            
                <button class="button-7" type="submit" id='submit' name="login" value='LOGIN'>Login</button>
                    <?php
                        if(isset($_GET['erreur'])){
                            $err = $_GET['erreur'];
                            if($err==1 || $err==2)
                                echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                        }
                    ?>
                </form>
            </div>
        </div>
    </body>
</html>