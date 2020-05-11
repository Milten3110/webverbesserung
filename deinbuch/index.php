<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta lang="de">
    <title>DeinBuch</title>
    <link rel="stylesheet" href="./engine/assets/css/style.css">
</head>

<body>
    <!-- Test -->
    <?php
    include "./engine/helper/datenbank/Chandle_db.php";
    $db = new datenbank();
    
    ?>

    <img src="engine/assets/bilder/home.png" alt="Bild für die Homepage" id="homeBtn">

    <!--   END TEST -->


    <?php 
        session_start();
        $_SESSION["login"] = 1;
    ?>
    <!-- NavContent -->
    <!-- Include NavBar -->
    <?php
    include "./engine/page/navigation.php";
    ?>

    <!-- Routing Content -->
    <div id="routing">
    <?php 
    include "./engine/helper/routing.php";
    ?>
    </div>
</body>


<footer id="footer">
    <a href="?p=impressum">Impressum</a>
</footer>

</html>