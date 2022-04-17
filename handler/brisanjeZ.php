<?php

require "../dbBroker.php";
require "../zaposleni.php";


if(isset($_POST['id'])) 
{
    $status = Zaposleni::izbrisiZaposlenog($_POST['id']),$conn);

    if($status){
        echo 'Success';
    }else{
        echo "Failed";
    }
}



?>