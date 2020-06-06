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
    private static $stmt_produktabfrage;
    private static $stmt_fulltextsearch;
    private static $stmt_login;

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

    private function openNewCon()
    {
        $tmpCon = new mysqli(self::DB_SERVER, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME, self::DB_PORT) or die("Connection Error!");
        return $tmpCon;
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
        self::$stmt_produktabfrage        = $this->conn->prepare("select * from produkt where id=?");
        self::$stmt_login                 = $this->conn->prepare("select * from account where username='?' and password='?' ");
    }



    public function login($loginName, $pw)
    {
        //anzeige wenn pw oder name falsch ist als falsche eingabe
        //@self::$stmt_login->bind_param("ss", $loginName, $pw);
        //self::$stmt_login->execute();
        //@self::$stmt_login->bind_result($id,$username,$password, $password, $treuepunkte);
        //echo $loginName;
        //echo "bevor if in login" . "<br>";
        //nach login erfolgreiche weiterleitung
        $tmpCon = $this->openNewCon();
        $result = $tmpCon->query("select * from account where username='$loginName' and password='$pw'");
        $result = $result->fetch_array();
        //echo var_dump($result);
        $_SESSION['account_id'] = $result['id'];
        if (isset($result[0])) {
            return true;
        } else {
            return false;
        }
    }


    //  create User
    public function createNewUser($userame, $password, $email, $vorname, $nachname, $geburtsdatum, $nummer = 0, $bundesland, $plz, $ort, $strasse, $hausnummer)
    {
        //Fehler, TODO: via Prepared Statements lösen
        //$nummer = "nonne";
        //self::$stmt_createAccount->bind_param("sss", $userame, $password, $email);
        //self::$stmt_createAccount->execute();
        //self::$stmt_createKunde->bind_param("ssssssssss", $vorname, $nachname, $geburtsdatum, $nummer, $bundesland, $plz, $ort, $strasse, $hausnummer, $userame);
        //self::$stmt_createKunde->execute();
        $tmpDb = $this->openNewCon();
        $tmpDb->query("insert into account(username,password, email, treuepunkte) values('$userame', '$password', '$email', 0)") or die("Fehler beim erstellen eines Kunden" . $tmpDb->error);
        $tmpID = $tmpDb->query("select id from account where username='$userame'");
        $tmpID = $tmpID->fetch_assoc();
        $id = $tmpID['id'];

        $tmpDb->query("insert into kunde(vorname, nachname, geburtsdatum, nummer, bundesland, plz, ort, strasse, hausnummer, account_id)
            values('$vorname','$nachname','$geburtsdatum', 0, '$bundesland','$plz','$ort','$strasse','$hausnummer', $id )") or die("Fehler: " . $tmpDb->error);
    }


    public function getProdukte()
    {
        $request = $this->conn->query("select * from produkt");
        return $request;
    }

    //TODO: falsche reihenfolge iwie bei verlag und isbn, findet sonst nicht 
    public function getIsbnProdukt($id)
    {
        @self::$stmt_produktabfrage->bind_param("i", intval($id));
        self::$stmt_produktabfrage->execute();
        self::$stmt_produktabfrage->bind_result($id, $name, $author, $isbn, $verlag, $preis, $genre_name);


        self::$stmt_produktabfrage->fetch();
        $tmparray['id']             = $id;
        $tmparray['name']           = $name;
        $tmparray['author']         = $author;
        $tmparray['isbn']           = $verlag;
        $tmparray['verlag']         = $isbn;
        $tmparray['preis']          = $preis;
        $tmparray['genre_name']     = $genre_name;

        return $tmparray;
    }


    public function getOrders($kundenID){
        $tmp = $this->openNewCon();
        $result = $tmp->query("select * from bestellungen where account_id=".$kundenID."");
        $tmp->close();
        return $result;
    }

    public function getUserInformation($kundenID){
        $tmp = $this->openNewCon();
        $result[0] = $tmp->query("select * from kunde where account_id=". $kundenID."");
        $result[1] = $tmp->query("select treuepunkte from account where id=". $kundenID. "");
        $tmp->close();
        return $result;
    }

    public function getGenre(){
        $tmp = $this->openNewCon();
        $result = $tmp->query("select genre_name from genre");
        $tmp->close();

        return $result;
    }

    public function directQuery($query){
        $tmp = $this->openNewCon();
        $result = $tmp->query($query);
        $tmp->close();
        return $result;
    }

    public function buy($punkte, $produkte)
    {
        $tmpDb = $this->openNewCon();
        $tmp = $this->getProdukte();

        //hinzufügung der bestllung
        foreach ($produkte as $isbn => $anzahl) {
            for($index = 0; $index < $anzahl; ++$index){
                $tmpDb->query("insert into bestellungen (account_id, produkt_id) values(".$_SESSION['account_id'].", (select id from produkt where isbn='". $isbn ."') )");
            }
        }
        //ändern der punkte
        
        $alterPunktestand = $tmpDb->query("select * from account where id=". intval($_SESSION['account_id']) ."");
        $alterPunktestand = $alterPunktestand->fetch_array();
        $alterPunktestand = $alterPunktestand['treuepunkte'];

        $neuerPunkteStand = $alterPunktestand + $punkte;
        $tmpDb->query("update account set treuepunkte = $neuerPunkteStand where id = ". $_SESSION['account_id'] ."");
        $tmpDb->close();
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

    public function suche($suchString)
    {
        //#### TODO: noch feinschliff, grundlage ist gelegt
        self::$stmt_fulltextsearch->bind_param("s", $suchString);

        self::$stmt_fulltextsearch->execute();
        self::$stmt_fulltextsearch->bind_result($id, $name, $author, $isbn, $verlag, $preis, $genre_name);

        $tmp_IDcounter = 0;
        while (self::$stmt_fulltextsearch->fetch()) {
            $idOfProducts[$tmp_IDcounter] = $id;
            ++$tmp_IDcounter;
            //echo $id . $name . $author . $isbn . $verlag . $preis . $genre_name . "<br>";
        }

        unset($tmp_IDcounter);
        self::$stmt_fulltextsearch->close();
        //need return
        return $idOfProducts = isset($idOfProducts) ? $idOfProducts : 0;
    }
}
