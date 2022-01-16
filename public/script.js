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

    let novy_riadok_elementy = document.getElementsByClassName("novy_riadok");
    if(novy_riadok_elementy != null) {
        for(i = 0; i< novy_riadok_elementy.length; i++) {
            let text = novy_riadok_elementy[i].innerHTML;
            text = text.replace(/\n/g, "<br>");
            novy_riadok_elementy[i].innerHTML = text;
        }
    }


    let regFormularUsername = document.getElementById("usernamepriregistracii");
    if(regFormularUsername != null) {
        regFormularUsername.oninput = (event) => {
            skontrolujCiNieJeTakyUzivatel(event.target.value);
        }
    }



}

function skontrolujCiNieJeTakyUzivatel(username) {
    let divExistujePouzivatel = document.getElementById("varovanieExistujePouzivatel");
    if(username.length > 3) {
        fetch("?c=prihlasenie&a=existujeUsername", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: "username="+username
        }).then(response => response.json())
            .then(response => {


                if(response == "ano") {
                    let varovanie = '</div> <div class="alert alert-danger" role="alert">'
                    varovanie+= 'Zadané užívateľské meno už existuje, vyberte si prosím iné '
                    varovanie += '</div>';
                    divExistujePouzivatel.innerHTML = varovanie;
                } else {
                    divExistujePouzivatel.innerHTML = "";
                }

            })
    } else {
        divExistujePouzivatel.innerHTML = "";
    }
}

