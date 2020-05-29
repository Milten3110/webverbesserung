<?php

class datenbank
{
    //global class variable
    private const DB_USERNAME   = 'root';
    private const DB_PASSWORD   = '';
    private const DB_SERVER     = 'localhost';
    private const DB_NAME       = 'webdb';
    private const DB_PORT       = 3306;

    private $conn;

    //  Prepared Statements
    private static $stmt_createAccount;
    private static $stmt_createKunde;
    private static $stmt_createGenre;
    private static $stmt_createProdukt;
    private static $stmt_createBestellung;
    private static $stmt_createKudenInteresse;
    private static $stmt_bestellungAbfrage;

    private static $stmt_fulltextsearch;

    function __construct()
    {
        $this->conn = new mysqli(self::DB_SERVER, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME, self::DB_PORT) or die("Connection Error!");
        $this->createStmts();
    }
    function __destruct()
    {
        $this->conn->close();
        unset($this->conn);
    }


    //###########################################################
    //##################----FUNKTIONEN----#######################
    //###########################################################


    //#todo TESTGet
    public function testQuery($queryStatement)
    {
        $result = $this->conn->query($queryStatement);
        return $result;
    }


    private function createStmts()
    {
        //  Preparet Statements
        self::$stmt_createAccount         = $this->conn->prepare("insert into Account (username,password,email,treuepunkte) values(?,?,?,0)");
        self::$stmt_createKunde            = $this->conn->prepare("insert into KUNDE (vorname, nachname,geburtsdatum, nummer, bundesland, plz, ort, strasse, hausnummer, account_id) 
            values(?,?,?,?,?,?,?,?,? (select id from ACCOUNT where username='?') ))");
        self::$stmt_createGenre           = $this->conn->prepare("insert into GENRE (genre_name) values(?)");
        self::$stmt_createProdukt         = $this->conn->prepare("insert into PRODUKT (name,author,verlag,isbn,preis,genre_id)
            values(?,?,?,?,?,(select id from GENRE where genre_name='?') )");
        self::$stmt_createBestellung      = $this->conn->prepare("insert into BESTELLUNGEN(account_id,bestelldatum,produkt_id) 
            values( (select id from ACCOUNT where username='?'),?,?)");
        self::$stmt_createKudenInteresse  = $this->conn->prepare("insert into KUNDEN_INTERESSE(genre,ausgeliehen,gekauft,kunden_id)
            values( (select genre_name from GENRE where id=? ),?,?,?)");
        self::$stmt_bestellungAbfrage     = $this->conn->prepare("select produkt_id as Produkt,bestelldatum from BESTELLUNGEN where account_id=?");
        self::$stmt_fulltextsearch        = $this->conn->prepare("call p_fullTextSearch(?)");
    }


    //  create User
    public function createNewUser($userame, $password, $email, $vorname, $nachname, $geburtsdatum, $nummer, $bundesland, $plz, $ort, $strasse, $hausnummer)
    {
        self::$stmt_createAccount->bind_param("sss", $userame, $password, $email);
        self::$stmt_createAccount->execute();
        self::$stmt_createKunde->bind_param("ssssssssss", $vorname, $nachname, $geburtsdatum, $nummer, $bundesland, $plz, $ort, $strasse, $hausnummer, $userame);
    }


    public function getProdukte()
    {

        $request = $this->conn->query("select * from produkt");
        return $request;
    }



    //  Fulltext Suche
    /*
        SET @QUERY = "roman";

        SELECT 
            id,
            NAME,
            author,
            isbn,
            verlag,
            preis,
            genre_name
        FROM (
            SELECT
                p.id,
                p.NAME,
                p.author,
                p.isbn,
                p.verlag,
                p.preis,
                g.genre_name,
                MATCH(p.NAME, p.author, p.verlag, p.isbn) AGAINST (@QUERY IN BOOLEAN MODE) AS MATCH1,
                MATCH(g.genre_name) AGAINST (@QUERY IN BOOLEAN MODE) AS MATCH2
            FROM produkt p
            INNER JOIN genre g ON g.id = p.genre_id
        ) AS q
        WHERE q.MATCH1 > 0 OR q.MATCH2 > 0
    */

    public function suche($suchString){
        
        //#### TODO: noch feinschliff, grundlage ist gelegt
        self::$stmt_fulltextsearch->bind_param("s",$suchString);
        
        self::$stmt_fulltextsearch->execute();
        self::$stmt_fulltextsearch->bind_result($id,$name,$author,$isbn,$verlag,$preis, $genre_name);
        
        while(self::$stmt_fulltextsearch->fetch() ){
            echo $id . $name . $author . $isbn . $verlag . $preis . $genre_name . "<br>";
        }

        self::$stmt_fulltextsearch->close();
    }
}
