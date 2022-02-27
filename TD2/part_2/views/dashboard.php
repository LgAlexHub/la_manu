<!DOCTYPE html>

<?php 
    $title='dashboard';
    require_once('./header.php');
?>

<body>
    <?php 
        require_once('./nav_bar.php');
    ?>
    <div class="center">
        <form method="POST" enctype="multipart/form-data" action="http://localhost/LAMANU/TD2/part_2/controllers/dashboard_controller.php/submit">
            <input type="file" class="button-7" name="fileToUpload" id="fileToUpload" />
            <button class="button-7" type="submit">Envoyer</button>
        </form>
        <img id="imgPreview">
        <?php
            if(isset($_GET['feedback'])){
                if($_GET['feedback_type'] == 0){
                    echo "<p style='color:green'>Upload réussi</p>";
                }else{  
                    echo "<p style='color:red'>".$_GET['feedback']."</p>";
                }
            }      
        ?>
    </div>
</body>
<script src="../assets/uploadPreview.js"></script>
</html>