<?php

class datenbank{
    //global class variable
    private const DB_USERNAME   = 'andy';
    private const DB_PASSWORD   = 'pw';
    private const DB_SERVER     = 'localhost';
    private const DB_NAME       = 'ownbeer';
    private const DB_PORT       = 3306;


    private $isConnOpen;
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD,self::DB_NAME,self::DB_PORT) or die("Connection Error!");    
    }
    function __destruct()
    {
        unset($conn);
    }

    //insert into db
    public function addItemToCard(){

    }
    public function delItemToCard(){

    }
    
}