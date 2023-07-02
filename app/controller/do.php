<!DOCTYPE html>
<html lang="en">
    <?php
    include TEMPLATES.'/head.php';
    ?>
    <body class="bg-dark">
    <?php
    include TEMPLATES.'/navbar.php';
    
    switch($_GET["list"]){
        case "series":
            include TEMPLATES.'/series.php';
        break;
        case "movies":
            include TEMPLATES.'/movies.php';
        break;
        default:
            header('Location: series');
    }
    ?>
    </body>
</html>