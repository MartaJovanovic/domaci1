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
                        <th scope="col">ID</th>
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
                            <td><?php echo $red["id"] ?></td>
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
                        <th scope="col">ID</th>
                        <th scope="col">Ime</th>
                        <th scope="col">Tip</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($red = $la->fetch_array()) :
                    ?>
                        <tr>
                            <td><?php echo $red["id"] ?></td>
                            <td><?php echo $red["ime"] ?></td>
                            <td><?php echo $red["tip_zaposlenog"] ?></td>
                        </tr>
                        <?php
                    endwhile;
                    ?>

                </tbody>
            </table>
    
            <div class="row">
                <div class="dugme" >
                    <button id="btn-dodajZ" type="button" class="btn" data-toggle="modal" data-target="#dodavanjeZ">Dodaj zaposlenog</button>
                </div>

                <div class="dugme" >
                    <button id="btn-izmeni" class="btn" data-toggle="modal" data-target="#izmeniZaposlenog">Izmeni zaposlenog</button>

                </div>

                <div>
                <input type="text" id="pretraga" onkeyup="funkcijaZaPretragu()" placeholder="Pretrazi po imenu">
                <button id="btn-pretraga" class="btn"> Pretrazi </button>
            </div>

            </div>
            <?php
            }
            else {
            ?>

            <div class="row">
                <div class="dugme" >
                    <button id="btn-dodajZ" type="button" class="btn" data-toggle="modal" data-target="#dodavanjeT">Dodaj termin</button>
                </div>

                <div class="dugme" >
                    <button id="btn-izmeni" class="btn" data-toggle="modal" data-target="#izmeniTermin">Izmeni termin</button>

                </div>

                <div class="dugme">
                    <button id="btn-obrisi" class="btn" data-toggle="modal" data-target="#brisanjeT">Obrisi termin</button>
                </div>

                <div class="dugme" >
                    <button id="btn-sortiraj" class="btn" onClick="sortiranjeDatum()">Sortiraj po datumu</button>
                </div>
            </div>
            <?php
            }
            ?>

            
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
                                        <label for="">tip zaposlenog</label>
                                        <input type="text" style="border: 1px solid black" name="tip_zaposlenog" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <button id="btnDodajZ" input type="submit" class="btn" >Dodaj</button>
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
                                    <label for="">ID</label>
                                        <input id="id" type="text" name="id" class="form-control"  value=""/>
                                    </div>
                                    <div class="form-group">
                                    <label for="">ime</label>
                                        <input id="ime" type="text" name="ime" class="form-control" value="" />
                                    </div>
                                    <div class="form-group">
                                    <label for="">Sifra</label>
                                        <input id="sifra" type="text" name="sifra" class="form-control"  value="" />
                                    </div>
                                    <div class="form-group">
                                    <label for="">Tip zaposlenog</label>
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




    <div class="modal fade" id="brisanjeT" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="brisanjeTermina">
                            <h3 style="color: black; text-align: center">Izbrisi termin</h3>
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label for="">ID</label>
                                        <input type="text" style="border: 1px solid black" name="id1" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <button id="btnIzbrisiT" input type="submit" class="btn" >Obrisi</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>


    </div>

    <div class="modal fade" id="dodavanjeT" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="dodajTermin">
                            <h3 style="color: black; text-align: center">Dodaj Termin</h3>
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label for="">usluga</label>
                                        <input type="text" style="border: 1px solid black" name="usluga" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">vreme</label>
                                        <input type="date" style="border: 1px solid black" name="vreme" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">zaposleni</label>
                                        <input type="text" style="border: 1px solid black" name="zaposleni" class="form-control" value="<?= $idSad ?>" />
                                        
                                    </div>
                                    <div class="form-group">
                                        <button id="btnDodajT" input type="submit" class="btn" >Dodaj</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>


    </div>




    <div class="modal fade" id="izmeniTermin" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="izmeniT">
                            <h3>Izmena zaposlenog</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="">ID</label>
                                        <input id="id" type="text" name="id" class="form-control"  value=""/>
                                    </div>
                                    <div class="form-group">
                                    <label for="">usluga</label>
                                        <input id="usluga" type="text" name="usluga" class="form-control" value="" />
                                    </div>
                                    <div class="form-group">
                                    <label for="">vreme</label>
                                        <input id="vreme" type="date" name="vreme" class="form-control"  value="" />
                                    </div>
                                    <div class="form-group">
                                    <label for="">zaposleni</label>
                                        <input id="zaposleni" type="text" name="zaposleni" class="form-control" value="<?= $idSad ?>" />
                                    </div>
                                    <div class="form-group">
                                        <button id="btnIzmeniT" type="submit" class="btn"> Izmeni</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
        function sortiranjeDatum() {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("tabela");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;
                console.log(rows.length);
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[2];
                    y = rows[i + 1].getElementsByTagName("TD")[2];

                    var a=x.innerHTML.split('-');
                    var b=y.innerHTML.split('-');


                    var d1=new Date(a[2],(a[1]-1),a[0]);
                    var d2=new Date(b[2],(b[1]-1),b[0]);
                  

                   if( (d1.getTime() > d2.getTime())) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        function funkcijaZaPretragu() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("pretraga");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabela1");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php
}
?>