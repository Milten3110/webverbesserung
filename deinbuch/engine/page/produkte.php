<!-- Suchleiste -->
<div id='suchleiste'>
    <?php
    include "./engine/page/suchleiste.php";
    if($_SESSION['gesucht'] && (!isset($_POST['variante1']) || !isset($_POST['variante2'])) ){
        $_SESSION['gesucht'] = false;
    }

    $searchresponse;
    // Minumum an Suchworten 
    //TODO: Valider
    if (isset($_POST['suchtext']) && strlen($_POST['suchtext']) >= 3) {
        if ($valider->validInput('suche', $_POST['suchtext'])) {
            $searchresponse = $db->suche($_POST['suchtext']);
            
            
            $_SESSION['gesucht'] = true;
        }
    }
    ?>
</div>

<div class='produktWrapp'>
    <!-- übersicht aller Produkte-->
    <!-- Anzeige der Sortierung: Kacheln: Klein, Groß, -->
    <div>
        <form action="" method="POST">
            <span>Ansichtsmodus </span>
            <input type="submit" name="variante1" value="Standart">
            <input type="submit" name="variante2" value="Groß">
            <input type="submit" name="anzeigen" value="Alle Anzeigen">
        </form>
    </div>

    <div>
        <!-- Anzeige der Symbole-->
        <div id="uebersichtKontainer">
            <?php
            
            // Kachelanzeige nach wunsch
            if (isset($_POST['variante1']) && @$_SESSION['variante'] != 'variante1') {
                $_SESSION['variante'] = 'variante1';
            }

            else if (isset($_POST['variante2']) && @$_SESSION['variante'] != 'variante2') {
                $_SESSION['variante'] = 'variante2';
            }
            else{
                // NOTING
            }

            //#TODO 
            // suchen zurück stellen
            if(isset($_POST['anzeigen']) && $_SESSION['gesucht'] === true){
                $_SESSION['gesucht'] = false;
            }







            //Not Best Pratices
            $produkte = $db->getProdukte() or die("Produkt Load Error!");
            if (!$_SESSION['gesucht']) {
                foreach ($produkte as $produkt) {
                    echo "<div class='$_SESSION[variante]'> <img src='./engine/assets/bilder/produkte/db_produkt/" . $produkt['isbn'] . ".jpg' alt=" . $produkt['name'] . ' Buch Bild> </div>';
                }
            }
            else{
                $tmpCounter = 0;
                //echo var_dump($searchresponse);
                foreach ($produkte as $produkt) {
                    if(@$produkt['id'] == @$searchresponse[$tmpCounter] && count(@$searchresponse) > $tmpCounter){
                        echo "<div class='$_SESSION[variante]'> <img src='./engine/assets/bilder/produkte/db_produkt/" . $produkt['isbn'] . ".jpg' alt=" . $produkt['name'] . ' Buch Bild> </div>';
                        ++ $tmpCounter;
                    }
                }
            }

            ?>
        </div>
    </div>










</div>