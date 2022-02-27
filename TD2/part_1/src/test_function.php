<?php 
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
?>