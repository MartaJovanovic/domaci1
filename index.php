<?php

require "dbBroker.php";
require "zaposleni.php";

session_start();
if(isset($_POST['ime']) && isset($_POST['sifra'])){
    $kime = $_POST['ime'];
    $ksifra = $_POST['sifra'];

    $korisnik = new Zaposleni(4,$kime, $ksifra);
    $odg = Zaposleni::logInZaposlemi($korisnik, $conn);



    if($odg->num_rows==1){
        echo "PRIJAVILI STE SE";
    }else{
        echo "NISTE STE SE";

    }


  /* if($odg->num_rows==1){
        echo  `
        <script>
        console.log( "Uspešno ste se prijavili");
        </script>
        `;
        echo "PRIJAVILI STE SE";
        $_SESSION['korisnik_id'] = $korisnik->id;
        header('Location: pocetna.php');
        exit();
    }else{
        echo `
        <script>
        console.log( "Niste se prijavili!");
        </script>
        `;

        echo "NISTE STE SE";

    }*/
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
                    <label class="username">Korisnicko ime</label>
                    <input type="text" name="username" class="form-control"  required>
                    <br>
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" class="form-control" required>
                    <button type="submit" class="btn btn-primary" onclick="sortTable()" name="submit">Prijavi se</button>
                </div>

            </form>
        </div>

        
    </div>
    <script>
        function sortTable() {
            
        }
        </script>



</body>
</html>