function upravKomentar(komentarID){
    let komentar_normal = document.getElementById("komentar_normal," + komentarID);
    let komentar_uprav = document.getElementById("komentar_uprav,"+ komentarID);

    komentar_normal.style.display = "none";
    komentar_uprav.style.display = "block";


}

function zursUpravovanie(komentarID) {
    let komentar_normal = document.getElementById("komentar_normal," + komentarID);
    let komentar_uprav = document.getElementById("komentar_uprav,"+ komentarID);

    komentar_normal.style.display = "block";
    komentar_uprav.style.display = "none";
}

window.onload = function() {
    /*
    zmazKomentar=document.getElementById('zmazKomentar');
    if(zmazKomentar != null) {
        zmazKomentar.onsubmit = function(e) {

            e.preventDefault();
            if(confirm("Naozaj chceš vymazať tento komentár??")) {
                this.submit();
            }
        }
    }*/

    let zmazFormulare = document.getElementsByClassName("zmazKomentar");
    if(zmazFormulare.length != null) {
        for(i = 0; i < zmazFormulare.length; i++) {
            zmazFormulare[i].onsubmit = function(e) {

                e.preventDefault();
                if (confirm("Naozaj chceš vymazať tento komentár??")) {
                    this.submit();
                }
            }
        }
    }
    /*
    let pridaj_komentar_form = document.getElementsByClassName("pridaj_komentar");
    if(pridaj_komentar_form != null) {
        pridaj_komentar_form[0].onsubmit = function(e) {
            e.preventDefault();
            text_area = document.getElementById("pridaj_komentar_area");
            text = text_area.value;
            text = text.replace(/\n/g, "<br>");
            text_area.value = text;

            this.submit()
        }
    }
    */

    let novy_riadok_elementy = document.getElementsByClassName("novy_riadok");
    if(novy_riadok_elementy != null) {
        for(i = 0; i< novy_riadok_elementy.length; i++) {
            let text = novy_riadok_elementy[i].innerHTML;
            text = text.replace(/\n/g, "<br>");
            novy_riadok_elementy[i].innerHTML = text;
        }
    }

    /*
    let pridaj_komentarFormulare = document.getElementsByClassName("pridaj_komentar");
    if(pridaj_komentarFormulare != null) {
        for(i = 0; i < pridaj_komentarFormulare.length; i++) {
            pridaj_komentarFormulare[i].onsubmit = function(e) {
                e.preventDefault();
                text = area_vloz_komentar.value;
                text = text + " ahoj ";
                area_vloz_komentar.value = text;
                this.submit();
            }
        }
    }
*/

}
    /*
    area_vloz_komentar = document.getElementById("area_vloz_komentar");
    if(area_vloz_komentar != null) {
        area_vloz_komentar.onsubmit = function(e) {
            e.preventDefault();
            text = area_vloz_komentar.value;
            text = text + " ahoj ";
            area_vloz_komentar.value = text;
            this.submit();
        }

}*/


/*
function pozastavMazanie(referencia) {
        referencia.onsubmit = function(e) {
        e.preventDefault();
        if(confirm("Naozaj chceš vymazať tento komentár??")) {

        }
    }
    this.submit();
}

*/