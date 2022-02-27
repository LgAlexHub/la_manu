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
    function render_dashboard(array $users){
        if(is_logged($users))
            header("Location: http://localhost/LAMANU/TD2/part_2/views/dashboard.php");
        else 
            header("Location: http://localhost/LAMANU/TD2/part_2/index.php");
        // sinon rajouter une page d'erreur
    }

    /**
     * Routeur, permet de choisir quelle fonction du controller choisir en fonction du point d'entrée
     * @param array $users list de tous les utilisateurs
     * @return void
     */
    function route($users){
        $route = explode('/',$_SERVER['REQUEST_URI']);
        //var_dump($route[sizeof($route)-1]);
        switch ($route[sizeof($route)-1]) {
            case 'submit':
                on_submit();
            break;
            case 'logout':
                on_logout();
            break;
            default:
                render_dashboard($users);
            break;
        }
    }

    /**
     * Vérifie si la première partie de l'upload fonctionne
     * @return void
     */
    function is_upload_form_working(){
        return isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error']==0;
    }
    
    /**
     * Vérifie si le fichier est une image
     * @return boolean true si c'est un image sinon false
     */
    function is_file_a_pic(string $filename){
        $format = [
            "jpg" => "image/jpg",
            "jpeg" => "image/jpeg",
            "gif" => "image/gif",
            "png" => "image/png"
        ];
        $extension= pathinfo($filename, PATHINFO_EXTENSION);
        return array_key_exists($extension, $format);
    }


    /**
     * Vérifie si l'image respecte la limite de taille
     * @param int $file_size taille du fichier
     * @return boolean return true si la condition est respectée
     */
    function is_file_small_enough(int $file_size){
        $max_size= 1024 * 1024 * 1;
        //1 octet =  8 bits
        // 1 Mo = 1 048 576 octets = 1024 * 1024
        return $file_size <= $max_size;
    }

    /**
     * Vérifie si l'image respectes les conditions avant l'upload
     * @return int code retour des tests 0 si ok, -1 si ce n'est pas un image, -2 si la taille est respectée
     */
    function upload_test(string $filename, int $max_size){
        if (!is_file_a_pic($filename)){
            return -1;
        }else if (!is_file_small_enough($max_size)){
            return -2;
        }else {
            return 0;
        }
    }

    /**
     * Retourne le chemin temporaire de l'image 
     * @return string
     */
    function get_tmp_file_path(){
        return $_FILES['fileToUpload']['tmp_name'];
    }

    /**
     * Retourne le nom de l'image 
     * @return string
     */
    function get_file_name(){
        return $_FILES['fileToUpload']['name'];
    }

    /**
     * Retourne la taille de l'image
     * @return int taille en bit
     */
    function get_file_size(){
        return $_FILES['fileToUpload']['size'];
    }

    /**
     * Retourne le strubg du future nouveau chemin de l'image
     * @param string $destination_directory le chemin du répertoire de destination
     * @param string $file_name le future nom de l'image
     * @return string future nouveau chemin
     */
    function set_tmp_file_new_path(string $destination_direcotry, $file_name){
        $file_name = uniqid(pathinfo($file_name, PATHINFO_FILENAME).'-').'.'.pathinfo($file_name, PATHINFO_EXTENSION);
        return $destination_direcotry.$file_name;
    }

    /**
     * Upload l'image sur le serveur
     * @param $tmp_path chemin de l'image à upload
     * @param $new_path chemin où uploader l'image
     * @return boolean contenant le résultat de l'upload , false si échoué, true si réussi 
     */
    function upload($tmp_path, $new_path){
        return move_uploaded_file($tmp_path, $new_path);
    }

    /**
     * Fonction qui gère l'arrivée du formulaire
     * @return void
     */
    function on_submit(){
        if(is_upload_form_working()){   // Vérifie si la première partie de l'upload est réussie
            // récupération d'info sur notre image
            $file_name= get_file_name(); 
            $file_size = get_file_size();
            
            $test_result= upload_test($file_name, $file_size); // test sur le type de fichier, et la taille
            
            if ($test_result == 0 ){ 
                $tmp_path = get_tmp_file_path(); // récupération du chemin temporaire
                $new_path= set_tmp_file_new_path('../img/',$file_name); // création du nouveau chemin où upload l'image
                if(upload($tmp_path, $new_path)){ // Test de la réussite de l'upload
                    header("Location: http://localhost/LAMANU/TD2/part_2/views/dashboard.php?feedback_type=0&feedback=".urlencode("Upload réussi"));
                }else{
                    header("Location: http://localhost/LAMANU/TD2/part_2/views/dashboard.php?feedback_type=1&feedback=".urlencode("Upload échoué"));
                }
            }else{
                require_once('../const/error_const.php');
                header("Location: http://localhost/LAMANU/TD2/part_2/views/dashboard.php?feedback_type=1&feedback=".urlencode(error_const[$test_result]));
            }
        }else{
            header("Location: http://localhost/LAMANU/TD2/part_2/views/dashboard.php?feedback_type=1&feedback=Aucun fichier détecté");
        }
    }

    function on_logout(){
        var_dump(session_destroy());
        header("Location: http://localhost/LAMANU/TD2/part_2/index.php");
    }


    route($users);
?>