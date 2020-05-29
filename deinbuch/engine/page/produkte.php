<!-- Suchleiste -->
<div id='suchleiste'>
    <?php
    include "./engine/page/suchleiste.php"
    ?>
</div>

<div class='produktWrapp'>


    <!-- Erst übersicht anzeigen, hier wird jedes buch angezeigt aber nur ein bild davon, was zu erkenne ist-->
    <!-- beim hover soll das einzelne Bild größer were ohne dass sich die ganze reihe verschiebt-->


    <!-- übersicht aller Produkte-->
    <div id="produktuebersicht">
        <div class="produktKachel">
aa
        </div>

        <div class="produktKachel">
aa
        </div>

        <div class="produktKachel">
aa
        </div>
    </div>








    <?php
    $produkte = $db->getProdukte() or die("Produkt Load Error!");
    foreach ($produkte as $produkt) {
    ?>
        <div class='produkt'>
            <div class='produktBild'>
                <img src="./engine/assets/bilder/produkte/db_produkt/<?php echo $produkt['isbn'] ?>.jpg" alt="<?php echo $produkt['name'] . ' Buch Bild' ?>">
            </div>
            <div class='produktSpec'>
                <p> Autor: <?php echo $produkt['author'] ?></P>
                <p> Preis: <?php echo $produkt['preis'] ?> </p>
                <p> Verlag: <?php echo $produkt['verlag'] ?></p>
            </div>
            <div class='produktBeschreibung'>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris porttitor ante at velit ullamcorper, 
                pretium cursus sem finibus. Pellentesque tristique ex in nunc auctor scelerisque. Praesent nec quam nibh. 
                Suspendisse nec laoreet lacus. Duis non fermentum leo. Fusce vitae magna et magna tristique consequat 
                quis ac diam. Suspendisse sapien quam, pellentesque in nibh at, mollis pellentesque nisi. Vivamus 
                vulputate velit quis tortor scelerisque, eu pulvinar libero tristique.
                </p>
                <form action="" method="post">
                    <input type="submit" name="kaufen_<?php echo $produkt['isbn']?>" value="In den Warenkorp">
                </form>
            </div>
        </div>
    <?php
    }
    ?>

</div>