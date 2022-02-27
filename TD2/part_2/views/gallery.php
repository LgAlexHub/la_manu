<!DOCTYPE html>

<?php 
    $title='Gallery';
    require_once('./header_lightbox.php');

    $pathes = explode(',',$_GET['picture_path']);
    unset($pathes[sizeof($pathes)-1]);
?>

<body>
    <?php 
        require_once('./nav_bar.php');
    ?>
    <div class="center">
        <div class="grid-container">
            <?php 
                foreach ($pathes as $path) {
                    echo "<a class=`\"grid-item example-image-link\" href=\"../img/".$path."\" data-lightbox=\"example-1\"><img  class=\"example-image\" heigh=\"100\" width=\"100\" src=\"../img/".$path."\" alt=\"image\"/></a>";
                }
            ?>
        </div>
    </div>
</body>
<script src="../node_modules/lightbox2/dist/js/lightbox-plus-jquery.js"></script>
</html>