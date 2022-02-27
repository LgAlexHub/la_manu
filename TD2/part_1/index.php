<?php 
    require('./src/test_function.php');
    require('./src/form_helper.php');
    require('./consts/error_const.php');

    if(is_upload_form_working()){   // Vérifie si la première partie de l'upload est réussie

        // récupération d'info sur notre image
        $file_name= get_file_name(); 
        $file_size = get_file_size();
        
        $test_result= upload_test($file_name, $file_size); // test sur le type de fichier, et la taille
        
        if ($test_result == 0 ){ 
            $tmp_path = get_tmp_file_path(); // récupération du chemin temporaire
            $new_path= set_tmp_file_new_path(__DIR__.'/img/',$file_name); // création du nouveau chemin où upload l'image
            if(upload($tmp_path, $new_path)){ // Test de la réussite de l'upload
                echo 'Upload réussis';
            }else{
                echo 'Upload échoué';
            }
        }else{
            echo "Erreur: ".error_const[$test_result];
        }
    }

?>

<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="./assets/uploadPreview.css">
        <title>Pic'Form</title>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data" action="http://localhost/LAMANU/TD2/part_1/index.php">
            <input type="file" name="fileToUpload" id="fileToUpload" />
            
            <img id="imgPreview">
            
            <button type="submit">Envoyer</button>
        </form>
    </body>
</html>
<script src="./assets/uploadPreview.js"></script>