<?php

require "../dbBroker.php";
require "../zaposleni.php";


if(isset($_POST['id']) && isset($_POST['ime']) && isset($_POST['sifra']) 
&& isset($_POST['tip_zaposlenog']) 
){

    $zaposleni = new Zaposleni($_POST['id'],$_POST['ime'],$_POST['sifra'],$_POST['tip_zaposlenog']);
    $status = Zaposleni::azuriranjeZaposlenog($zaposleni, $conn);

    if($status){
        echo 'Success';
    }else{
        echo "Failed";
    }
}



?>