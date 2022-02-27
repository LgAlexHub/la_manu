<?php 
    Class CalendarController{
        /**
         * Le contrôlleur du calendrier 
         */

        function __construct(){
          
        }


        /**
         * Vérifie si l'url possède les paramètres requis
         * @return array tableau associatif avec code réponse, et texte explicatif si erreur
         */
        function check_url(){
            $error_array = [
                'number' => 0,
                'content' => ''
            ];
            if ( !isset($_GET['month']) || !isset($_GET['year']) ){
                $error_array['number']=-1;
                $error_array['content']= 'Le lien ne correspond pas à mes attentes';
            }
            elseif ( !$this->is_int($_GET['month']) || !$this->is_int($_GET['year']) ){
                $error_array['number']=2;
                $error_array['content']= 'Les paramètres de ce lien ne sont pas bon';
            }
            elseif ( ($_GET['month'] < 0 || $_GET['month'] > 12) || $_GET['year'] < 0 ){
                $error_array['number']=-3;
                $error_array['content']= 'Le mois doit êtres compris entre 1 et 12, l\'année doit être supérieur à 0';
            }else {
                $error_array['number']=0;
            }
            return $error_array;
        }
        
        /**
         * Vérifie si le texte peut être parse en int
         * @param string $string, texte à faire vérifier
         * @return boolean true si c'est possible 
         */
        function is_int(string $string){
            return intval($string) != 0;
        }

        /**
         * Retourne le nombre de jours d'un mois
         * @param int $month le numéro du mois
         * @param int $year l'année
         * 
         * @return int le nombre de jours dans le mois
         */
        function getNumberOfDayInMonth(int $month, int $year){
            return cal_days_in_month(CAL_GREGORIAN,$month, $year);
        }

        /**
         * Affiche la view du calendrier
         * @return void
        */
        function render_calendar(){
            $error_array= $this->check_url();
            if ($error_array['number'] == 0){
                $month= $_GET['month'];
                $year= $_GET['year'];
                $number_of_day= $this->getNumberOfDayInMonth($month, $year);
                $time= mktime(0,0,0,$month,1,$year);
                $firstday = strtolower(date('l',$time));
                $back_link = $this->back_link_builder($month, $year);
                $next_link = $this->next_link_builder($month,$year);
                require './templates/calendar.php';
            }else {
                require './templates/error.php';
            }
        }
        
        /**
         * Génère le string de l'url pour passer au mois suivant
         * @param int le numéro du mois
         * @param int l'année
         * @return string
         */
        function next_link_builder(int $month, int $year){
            if ($month + 1 > 12 ){
                return "http://localhost/LAMANU/TD1/?month=1&year=".$year+1;
            }else{
                return "http://localhost/LAMANU/TD1/?month=".($month+1)."&year=$year";
            }
        }

        /**
         * Génère le string de l'url pour passer au mois précédent
         * @param int le numéro du mois
         * @param int l'année
         * @return string
         */
        function back_link_builder(int $month, int $year){
            if ($month - 1 < 1 ){
                return "http://localhost/LAMANU/TD1/?month=12&year=".$year-1;
            }else{
                return "http://localhost/LAMANU/TD1/?month=".($month-1)."&year=$year";
            }
        }
    }
?>