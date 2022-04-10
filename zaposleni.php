<?php

class Zaposleni{
    public $id;
    public $ime;
    public $sifra;
    public $tip_zaposlenog;

    public function __construct($ime=null,$sifra=null,$tip_zaposlenog=null,$id=null)
    {
        $this->id = $id;
        $this->ime = $ime;
        $this->sifra = $sifra;
        $this->tip_zaposlenog = $tip_zaposlenog;
    }

    public static function logInZaposleni($koris, mysqli $conn)
    {
        $query = "SELECT * FROM user WHERE ime='$koris->ime' and sifra='$koris->sifra'";
        return $conn->query($query);
    }
}


?>