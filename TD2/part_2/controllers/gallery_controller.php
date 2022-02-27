<?php
    require_once('../my-config.php');

    /**
     * Vérifie si l'utilisateur est connecté
     * @param array $users list de tous les utilisateurs
     * @return boolean return true si il est connecté
     */
    function is_logged(array $users){
        session_start();
        if (isset($_SESSION['id'])){
            $user_id = $_SESSION['id'];
            if(isset($users[$user_id])){
                return true;
            }
        }
        return false;
    }

    /**
     * Redirige vers la vue de la dashboard
     * @param array $users list de tous les utilisateurs
     * @return void
     */
    function render_gallery(array $users){
        if(is_logged($users))
            header("Location: http://localhost/LAMANU/TD2/part_2/views/gallery.php?picture_path=".get_picture_path());
        else 
            header("Location: http://localhost/LAMANU/TD2/part_2/index.php");
        // sinon rajouter une page d'erreur
    }

    function get_picture_path(){
        $img_path = scandir('../img/');
        unset($img_path[0]);
        unset($img_path[1]);
        $return_string = '';
        foreach ($img_path as $path) {
            $return_string.= $path.',';
        }
        return $return_string;
    }


    render_gallery($users);
?>