<?php
    require_once('../my-config.php');
    
    function check_credentials(array $users){
        $is_credentials_correct = false;
        $username='';
        $index_of_user= -1;
        if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])){
            $username = $_POST['username'];
            $client_password = $_POST['password'];
            $index_of_user = index_of_username($username, $users);
            if ($index_of_user != -1){              
                if(check_password($client_password, $users[$index_of_user]['password'])){
                    $is_credentials_correct = true;
                }
            }
        }
        
        if($is_credentials_correct){
            create_session($username, $index_of_user);
            redirect_to_dashboard();
        }else{
            back_to_login_with_errors();
        }
    }

    function index_of_username(string $username, array $users){
        $result= -1;
        for ($i = 0 ; $i < sizeof($users) ; $i++){
            if($users[$i]['username'] == $username){
                $result= $i;
                break;
            }
        }
        return $result;
    }

    function check_password(string $client_password, string $known_password){
        $client_hashed_password = hash('md5',$client_password);
        return hash_equals($known_password, $client_hashed_password);
    }

    function redirect_to_dashboard(){
        header("Location: http://localhost/LAMANU/TD2/part_2/controllers/dashboard_controller.php");
    }
    
    function back_to_login_with_errors(){
        header("Location: http://localhost/LAMANU/TD2/part_2/index.php?erreur=1");
    }

    function create_session(string $username, int $id){
        session_start();
        $_SESSION['username']= $username;
        $_SESSION['id']= $id;
    }
    
    check_credentials($users);

?>