<?php

require "../dbBroker.php";
require "../zaposleni.php";


if(isset($_POST['id'])) 
{
    $obj = new Zaposleni($_POST['id']);
    
    $status = $obj->deleteById($conn);

    if($status){
        echo 'Success';
    }else{
        echo "Failed";
    }
}



?>