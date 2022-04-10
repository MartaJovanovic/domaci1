<?php

require "dbBroker.php";
require "termin.php";

session_start();
if (!isset($_SESSION['korisnik_id'])) {
    header('Location: index.php');
    exit();
}
else {
    $idSad = $_SESSION['korisnik_id'];
}

if ($idSad != 3){
    $termin = Termin::prikaziPremaZanimanju($idSad,$conn);
}
else {
    $termin = Termin::prikaziSve($conn);
}
if (!$termin) {
    echo "Nastala je greška pri preuzimanju podataka";
    die();
}
if ($termin->num_rows == 0) {
    echo "Nema prijava na kolokvijume";
    die();
} else {


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css">
    <title>SALON</title>

</head>
<body>
<div class="naslov">
        <h1>Termini:</h1>
    </div>
    <table id="tabela" class="table table-hover table-striped">
                <thead class="thead">
                    <tr>
                        <th scope="col">Usluga</th>
                        <th scope="col">Vreme</th>
                        <th scope="col">Sifra zaposlenog</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($red = $termin->fetch_array()) :
                    ?>
                        <tr>
                            <td><?php echo $red["usluga"] ?></td>
                            <td><?php echo $red["vreme"] ?></td>
                            <td><?php echo $red["zaposleni"] ?></td>
                        </tr>
                        <?php
                    endwhile;
                    ?>

                </tbody>
            </table>

            <div class="row">
                <div class="col-md-1" >
                    <button id="btn-izmeni" class="btn btn-warning" data-toggle="modal" data-target="#izmeniModal">Izmeni</button>

                </div>

                <div class="col-md-12">
                    <button id="btn-obrisi" formmethod="post" class="btn btn-danger" >Obrisi</button>
                </div>

                <div class="col-md-2" >
                    <button id="btn-sortiraj" class="btn btn-normal">Sortiraj</button>
                </div>

            </div>



</body>
</html>
<?php
}
?>