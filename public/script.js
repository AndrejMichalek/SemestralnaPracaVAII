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

    let zmazKrok = document.getElementsByClassName("zmazKrok");
    if(zmazKrok.length != null) {
        for(i = 0; i < zmazKrok.length; i++) {
            zmazKrok[i].onsubmit = function(e) {

                e.preventDefault();
                if (confirm("Naozaj chceš vymazať tento krok návodu??")) {
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


    let nazovnavodu = document.getElementById("nazovnavodu");
    if(nazovnavodu != null) {
        nazovnavodu.oninput = (event) => {
            let divkoHlaska = document.getElementById("navodulozeny");
            if(divkoHlaska != null) {
                divkoHlaska.innerHTML ="";
            }
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


function upravKrok(krokID){
    let divko_normal = document.getElementById("normal," + krokID);
    let divko_uprav = document.getElementById("uprava,"+ krokID);

    divko_normal.style.display = "none";
    divko_uprav.style.display = "block";


}

function zrusUpravovanieKroku(krokID){
    let divko_normal = document.getElementById("normal," + krokID);
    let divko_uprav = document.getElementById("uprava,"+ krokID);

    divko_normal.style.display = "block";
    divko_uprav.style.display = "none";


}


/**
function vygenerujKroky() {
    let divko = document.getElementById("krokyNavodu");


    fetch('?c=navody&a=dajKrokyNavodu&navodid=1')
        .then(response => response.json())
        .then(data => {
            let html = "";
            for(let krok of data) {
                html += '<div className="container mb-3">';
                html+=    '<div className="row">'
                html+=        '<div className="card col-sm-8">'
                html+=            '<img className="card-img-top mt-2" src="public/obrazky/navody/' + krok.obrazok + '"'
                html+=                 'alt="obrazok kroku">'
                html+=                    '<div className="card-body ">'
                html+=                    '</div>'
                html+=           '</div>'
                html+=            '<div className="card col-sm-4">'
                html+=
                    html+=    '<div className="card-body">'
                html+=                    '<h3 className="card-title">' + krok.nazov + '</h3>'
                html+=
                    html+=     '<p className="obsahotazky">'
                html+=                         krok.obsah
                html+=                    '</p>'

                        html+=        ' </div>'
                html+=            '</div>'
                html+=         '</div>'
                html+=    '</div>'


            }
            divko.innerHTML=html;
            }
        )


}








class NavodEditor {
    navodID;
    divDoKtorehoToDat;
    krokyNavodu;


    constructor(navodID) {
        this.navodID = navodID;

        this.divDoKtorehoToDat = document.getElementById("krokyNavodu");
        this.divDoKtorehoToDat.innerHTML = navodID;
    }

    vykresliKrokyNavodu() {


    }

    vypisA() {
        this.divDoKtorehoToDat.innerHTML = 5;
    }




}**/