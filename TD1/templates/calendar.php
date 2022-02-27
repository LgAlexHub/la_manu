<?php
    include_once('./consts/const.php');
    $day_counter=1;
?>

<!DOCTYPE html>
    <head>
        <meta charset="UTF-8"/>
        <title>Alex's Calendar</title>
    </head>
    <body>
        <h2>
            <?php 
                echo Date('M Y', mktime(0,0,0,$month,1,$year))
            ?>
        </h2>

        <table border="1" style="text-align: center;">
            <thead>
                <tr>
                    <?php
                        foreach (day_array as $key => $value) {
                            echo "<th>$value</th>";
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php 
                        for ($i = 0 ; $i < 7 ; $i ++){
                            if ($i >=  array_search($firstday, day_array)){
                                echo "<td>$day_counter</td>";
                                $day_counter ++;
                            }else{
                                echo "<td></td>";
                            }
                           
                        }
                    ?>
                </tr>
                <?php
                    while($day_counter <= $number_of_day){
                        echo '<tr>';
                        for ($i = 0 ; $i < 7 ; $i ++){
                            if ($day_counter <= $number_of_day)
                                echo "<td>$day_counter</td>";
                            else 
                                echo "<td></td>";
                            $day_counter ++;
                        }
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
        <a href=<?= $back_link ?>>Previous</a>
        <a href=<?= $next_link ?>>Next</a>
    </body>
    <footer>
    </footer>
</html>