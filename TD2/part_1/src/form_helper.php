<?php 
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
?>