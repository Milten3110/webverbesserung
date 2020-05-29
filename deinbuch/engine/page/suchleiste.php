<div id="suchleistenKontainer">
    <!-- TODO : VALID INIT-->
    <?php
    if(isset($_POST['suchtext']) && strlen($_POST['suchtext']) >= 4 ){
        $db->suche($_POST['suchtext']);
    }
    ?>

    <form action="" method="POST">
        <div id="suchInputElemts">
            <input id="suchfeld" name="suchtext" type="text" placeholder="Titel, Autor, Verlag, Genre, ISBN">
            <input id='suchBtn' type="submit" value="Suchen">
        </div>
    </form>
</div>