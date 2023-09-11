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
}