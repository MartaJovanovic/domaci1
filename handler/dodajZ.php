<?php

require "../dbBroker.php";
require "../zaposleni.php";


if(isset($_POST['ime']) && isset($_POST['sifra']) 
&& isset($_POST['tip_zaposlenog']) 
){

    $zaposleni = new Zaposleni(null,$_POST['ime'],$_POST['sifra'],$_POST['tip_zaposlenog']);
    $status = Zaposleni::dodajZaposlenog($zaposleni, $conn);

    if($status){
        echo 'Success';
    }else{
        echo "Failed";
    }
}



?>