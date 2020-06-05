<div id="suchleistenKontainer">
    <!-- TODO : VALID INIT-->
    <form action="" method="POST">
        <div id="suchInputElemts">
            <input id="suchfeld" name="suchtext" type="text" placeholder="Titel, Autor, Verlag, Genre, ISBN">
            <input id='suchBtn' type="submit" value="Suchen">
            <select name="" id="kategorieSelect">

            <!-- Add Option from DB-->
            <!-- An sich keine Funktion Ohne JS -->
            <?php
                $result = $db->getGenre();
                //$result = $result->fetch_assoc();
                
                foreach ($result as $genre) {
                    echo "<option>" . $genre['genre_name']. "</option>";
                }
            ?>

            </select>

        </div>
    </form>
</div>