function contadorDeNotificacoes() {
    notificacao = document.getElementById("contNot");
    if (localStorage.getItem("Click")) {
        document.getElementById("contNot").textContent = 0;
    }
}

function timelineVersions(){
    localStorage.setItem("Click", true);
    document.getElementById("contNot").textContent = 0;
    window.location.href = "/timeline";
}
