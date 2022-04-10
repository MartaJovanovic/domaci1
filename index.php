<?php

require "dbBroker.php";
require "zaposleni.php";

session_start();
if(isset($_POST['id']) && isset($_POST['ime']) && isset($_POST['sifra'])){
    $kid = $_POST['id'];
    $kime = $_POST['ime'];
    $ksifra = $_POST['sifra'];

    $korisnik = new Zaposleni($kid,$kime, $ksifra);
    $odg = Zaposleni::logInZaposleni($korisnik, $conn);


   if($odg->num_rows==1){
        $_SESSION['korisnik_id'] = $korisnik->id;
        ob_start();
        header('Location: pocetna.php');
        ob_end_flush();
        exit();
    }else{
        echo `
        <script>
        console.log( "Niste se prijavili!");
        </script>
        `;

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css">
    <title>FON: Zakazivanje kolokvijuma</title>

</head>
<body>
<div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <div class="container">
                <label class="id">ID</label>
                    <input type="text" name="id" class="form-control"  required>
                    <br>
                    <label class="ime">Korisnicko ime</label>
                    <input type="text" name="ime" class="form-control"  required>
                    <br>
                    <label for="password">Lozinka</label>
                    <input type="password" name="sifra" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
                </div>

            </form>
        </div>

        
    </div>



</body>
</html>