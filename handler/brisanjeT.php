<?php

require "../dbBroker.php";
require "../termin.php";

if(isset($_POST['id1'])) 
{

    $id_ = $_POST['id1'];

    $status = Termin::izbrisiTermin($id_,$conn);

    if($status){
        echo 'Success';
    }else{
        echo "Failed";
    }
}



?>