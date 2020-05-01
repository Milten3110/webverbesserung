<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta lang="de">
    <title>DeinBuch</title>
    <link rel="stylesheet" href="./engine/assets/css/style.css">
</head>

<body>
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


<footer>
</footer>

</html>