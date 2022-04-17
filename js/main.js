$('#dodajZaposlenog').submit(function(){


    event.preventDefault();
    console.log("Dodavanje");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    $input.prop('disabled', true);

    req = $.ajax({
        url: 'handler/dodajZ.php',
        type:'post',
        data: serijalizacija
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
            alert("Zaposlen DODAT");
            location.reload(true);
        }else if (res == "Failed"){
            alert("Zaposlen NIJE DODAT");
        }
        else {
            alert("Zaposlen NIJE");
        }
        console.log(res);
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});

$('#btnDodajZ').submit(function () {
    $('#dodavanjeZ').modal('toggle');
    return false;
});



$('#izmeniZ').submit(function(){


    event.preventDefault();
    console.log("Izmena");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    $input.prop('disabled', true);

    req = $.ajax({
        url: 'handler/izmenaZ.php',
        type:'post',
        data: serijalizacija
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
            alert("Zaposlen izmenjen");
            location.reload(true);
        }else if (res == "Failed"){
            alert("Zaposlen NIJE izmenjen");
        }
        else {
            alert("Zaposlen NIJE");
        }
        console.log(res);
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});


$('#brisanjeTermina').submit(function(){
    console.log("Da li si stigla do ovde?");
    event.preventDefault();
    console.log("Brisanje");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    $input.prop('disabled', true);

    req = $.ajax({
        url: 'handler/brisanjeT.php',
        type:'post',
        data: serijalizacija
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
            alert("Termin OBRISAN");
            location.reload(true);
        }else if (res == "Failed"){
            alert("Termin NIJE obrisan");
        }
        else {
            alert("Termin NIJE");
        }
        console.log(res);
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});


$('#dodajTermin').submit(function(){


    event.preventDefault();
    console.log("Dodavanje");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    $input.prop('disabled', true);

    req = $.ajax({
        url: 'handler/dodajT.php',
        type:'post',
        data: serijalizacija
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
            alert("Termin DODAT");
            location.reload(true);
        }else if (res == "Failed"){
            alert("Termin NIJE DODAT");
        }
        else {
            alert("Termin NIJE");
        }
        console.log(res);
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});

$('#btnDodajT').submit(function () {
    $('#dodavanjeT').modal('toggle');
    return false;
});

$('#izmeniT').submit(function(){


    event.preventDefault();
    console.log("Izmena");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    $input.prop('disabled', true);

    req = $.ajax({
        url: 'handler/izmeniT.php',
        type:'post',
        data: serijalizacija
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
            alert("Termin izmenjen");
            location.reload(true);
        }else if (res == "Failed"){
            alert("Termin NIJE izmenjen");
        }
        else {
            alert("Termin NIJE");
        }
        console.log(res);
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});