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

     public static function prikaziPremaZanimanju($zaposleni, mysqli $conn)
     {
        $query = "SELECT * FROM termin WHERE zaposleni IN (SELECT id FROM zaposleni WHERE tip_zaposlenog = (SELECT tip_zaposlenog FROM zaposleni WHERE id=$zaposleni))";
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

 
     public static function izbrisiTermin($id1, mysqli $conn)
     {
         $query = "DELETE FROM termin WHERE id=$id1";
         return $conn->query($query);
     }
 
    
     public static  function azuriranjeTermina($termin, mysqli $conn)
     {
        $query = "UPDATE termin set usluga='$termin->usluga',vreme='$termin->vreme',zaposleni='$termin->zaposleni' WHERE id='$termin->id'";
        return $conn->query($query);
     }
 
    
     public static function dodajTermin(Termin $termin, mysqli $conn)
     {
         $query = "INSERT INTO termin(usluga, vreme, zaposleni) VALUES('$termin->usluga','$termin->vreme','$termin->zaposleni')";
         return $conn->query($query);
     }
}


?>