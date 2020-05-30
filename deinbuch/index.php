<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta lang="de">
    <title>DeinBuch</title>
    <link rel="stylesheet" href="./engine/assets/css/style.css">
</head>

<body>
    <!-- Classen -->
    <?php
    include "./engine/helper/datenbank/Chandle_db.php";
    include "./engine/helper/Cvalider.php";

    $db         = new datenbank();
    $valider    = new CValider();
    
    ?>

    <!--   END TEST -->

    <?php
    session_start();
    $_SESSION["login"] = 0;
    ?>

    <!-- NavContent -->
    <!-- Include NavBar -->
    <?php
    include "./engine/page/navigation.php";
    ?>





    <!-- SeitenEffeckt -->
    <div class="left-gradient darkeffeckt">
    </div>
    <div class="right-gradient darkeffeckt">
    </div>

    <!-- Routing Content -->
    <div id="routing">
        <div id="routingContent">
            <?php
            
            

            include "./engine/helper/routing.php";
            ?>
        </div>
    </div>
</body>


<footer id="footer">
    <a href="?p=impressum">Impressum</a>
</footer>

</html>