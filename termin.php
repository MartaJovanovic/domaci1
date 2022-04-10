<?php

class Termin{
    public $id;
    public $usluga;
    public $vreme;
    public $zaposleni;

    public function __construct($id=null,$usluga=null,$vreme=null,$zaposleni=null)
    {
        $this->id = $id;
        $this->usluga = $usluga;
        $this->vreme = $vreme;
        $this->zaposleni = $zaposleni;
    }


     public static function prikaziSve(mysqli $conn)
     {
         $query = "SELECT * FROM termin";
         return $conn->query($query);
     }
 
     public static function nadjiTermin($id, mysqli $conn){
         $query = "SELECT * FROM termin WHERE id=$id";
 
         $myObj = array();
         if($msqlObj = $conn->query($query)){
             while($red = $msqlObj->fetch_array(1)){
                 $myObj[]= $red;
             }
         }
 
         return $myObj;
 
     }

 
     public function izbrisiTermin(mysqli $conn)
     {
         $query = "DELETE FROM termin WHERE id=$this->id";
         return $conn->query($query);
     }
 
    
     public function azuriranjeTermina($id, mysqli $conn)
     {
         $query = "UPDATE termin set usluga = $this->uskuga,vreme = $this->vreme,zaposleni = $this->zaposleni WHERE id=$id";
         return $conn->query($query);
     }
 
    
     public static function dodajTermin(Termin $termin, mysqli $conn)
     {
         $query = "INSERT INTO termin(usluga, vreme, zaposleni) VALUES('$termin->usluga','$termin->vreme','$termin->zaposleni')";
         return $conn->query($query);
     }
}


?>