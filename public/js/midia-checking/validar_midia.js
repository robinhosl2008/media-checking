window.onload = function() {
    var elemArquivo = document.getElementById('arquivo');
    elemArquivo.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            var file = new FileReader();
            file.onload = function(e) {
                document.getElementById('imagem_modal').src = e.target.result;
            };
            file.readAsDataURL(this.files[0]);
        }
    }, false);

    // var btnLaranjaValidar = document.querySelector('.btn-laranja-validar');
    // btnLaranjaValidar.addEventListener('click', function() {

        

        // var modal = $('#exampleModal');
        // modal.show();
    // })
}

function validarFormulario() {
    var tipoMidia = document.getElementById('tipo_midia').value,
        vertical = document.getElementById('vertical').value,
        produto = document.getElementById('produto').value,
        arquivo = document.getElementById('arquivo');

    if (tipoMidia == 0 || vertical == 0 || produto == 0 || (!arquivo.files && !arquivo.files[0])) {
        exibirAlertaDeInput('warning', 'Todos os campos são obrigatórios.');
        return;
    }

    document.querySelector('#open-modal').click();
}