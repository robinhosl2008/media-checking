function exibirAlertaDeInput(tipo = null, texto = null, campo = null, legenda = null) {
    var divAlertJs;

    if (tipo && texto) {
        divAlertJs = document.getElementById('alertas');
        htmlAlertJs = `
            <div id="alert" class="alert alert-`+tipo+`" role="alert">
                <p class="mb-0">
                    `+texto+`
                </p>
            </div>`;
        divAlertJs.innerHTML = '';
        divAlertJs.innerHTML = htmlAlertJs;
    }

    if (campo) {
        // campo.style.border = '1px solid red';

        if (legenda) {
            legenda.style.display = 'block';
        }
    }

    removeAlert(divAlertJs, campo, legenda);
}

function removeAlert(element, campo, legenda) {
    if (campo) {
        campo.addEventListener('click', function() {
            // this.style.border = '';

            if (legenda) {
                legenda.style.display = 'none';
            }
        });
    }

    if (element) {
        setTimeout(() => {
            element.innerHTML = '';
        }, 10000);
    }
}