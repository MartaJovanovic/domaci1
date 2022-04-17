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
