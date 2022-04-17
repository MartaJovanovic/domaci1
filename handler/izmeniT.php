<?php

require "../dbBroker.php";
require "../termin.php";


if(isset($_POST['id']) && isset($_POST['usluga']) && isset($_POST['vreme']) 
&& isset($_POST['zaposleni']) 
){

    $termin = new Termin($_POST['id'],$_POST['usluga'],$_POST['vreme'],$_POST['zaposleni']);
    $status = Termin::azuriranjeTermina($termin, $conn);

    if($status){
        echo 'Success';
    }else{
        echo "Failed";
    }
}


?>