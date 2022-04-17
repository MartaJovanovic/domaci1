<?php

require "dbBroker.php";
require "termin.php";
require "zaposleni.php";

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
    $la = Zaposleni::prikaziZ($conn);
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>SALON</title>

</head>
<body>

<div>
        <h1>Termini:</h1>
</div>

<div>

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
<?php
            if ($idSad == 3){
                ?>
            <table id="tabela1" class="table table-hover table-striped">
                <thead class="thead">
                    <tr>
                        <th scope="col">Usluga</th>
                        <th scope="col">Vreme</th>
                        <th scope="col">Sifra zaposlenog</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($red = $la->fetch_array()) :
                    ?>
                        <tr>
                            <td><?php echo $red["id"] ?></td>
                            <td><?php echo $red["ime"] ?></td>
                            <td><?php echo $red["sifra"] ?></td>
                        </tr>
                        <?php
                    endwhile;
                    ?>

                </tbody>
            </table>
            

            <?php
            }
            if ($idSad == 3) {
                ?>
            <div class="dugme" >
            <button id="btn-dodajZ" type="button" class="btn" data-toggle="modal" data-target="#dodavanjeZ">Dodaj zaposlenog</button>
            </div>
            <?php
            }
            ?>

            <div class="row">
                <div class="dugme" >
                    <button id="btn-izmeni" class="btn" data-toggle="modal" data-target="#izmeniZaposlenog">Izmeni</button>

                </div>

                <div class="dugme">
                    <button id="btn-obrisi" formmethod="post" class="btn" >Obrisi</button>
                </div>

                <div class="dugme" >
                    <button id="btn-sortiraj" class="btn btn-normal">Sortiraj</button>
                </div>

            </div>

            
    <div class="modal fade" id="dodavanjeZ" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="dodajZaposlenog">
                            <h3 style="color: black; text-align: center">Dodaj Zaposlenog</h3>
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label for="">ime</label>
                                        <input type="text" style="border: 1px solid black" name="ime" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">sifra</label>
                                        <input type="text" style="border: 1px solid black" name="sifra" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="tip_zaposlenog">tip zaposlenog</label>
                                        <input type="tip_zaposlenog" name="tip_zaposlenog" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <button id="btnDodajZ" input type="submit" class="btn" onClick=>Dodaj</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>


    </div>




    <div class="modal fade" id="izmeniZaposlenog" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="izmeniZ">
                            <h3>Izmena zaposlenog</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="id" type="text" name="id" class="form-control"  value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input id="ime" type="text" name="ime" class="form-control" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="sifra" type="text" name="sifra" class="form-control"  value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="tip_zaposlenog" type="text" name="tip_zaposlenog" class="form-control" value="" />
                                    </div>
                                    <div class="form-group">
                                        <button id="btnIzmeniZ" type="submit" class="btn"> Izmeni</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php
}
?>