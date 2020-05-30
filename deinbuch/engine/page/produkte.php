<!-- Suchleiste -->
<div id='suchleiste'>
    <?php
    include "./engine/page/suchleiste.php";

    // Minumum an Suchworten 
    //TODO: Valider
    if (isset($_POST['suchtext']) && strlen($_POST['suchtext']) >= 3) {
        $valider->validInput('suche',$_POST['suchtext']);
        //$db->suche($_POST['suchtext']);
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
        </form>
    </div>

    <div>
        <!-- Anzeige der Symbole-->
        <div id="uebersichtKontainer">
            <?php
            $variante = 'variante1';

            // Kachelanzeige nach wunsch
            if (isset($_POST['variante1']) && $variante != 'variante1') {
                $variante = 'variante1';
            }

            if (isset($_POST['variante2']) && $variante != 'variante2') {
                $variante = 'variante2';
            }

            $produkte = $db->getProdukte() or die("Produkt Load Error!");
            foreach ($produkte as $produkt) {
                echo "<div class='$variante'> <img src='./engine/assets/bilder/produkte/db_produkt/" . $produkt['isbn'] . ".jpg' alt=" . $produkt['name'] . ' Buch Bild> </div>';
            }
            ?>
        </div>
    </div>










</div>