const ajax = new Ajax();
const spinner = new Spinner();

spinner.exibe();

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

    let selectVerticais = document.getElementById('vertical');
    let selectProdutos = document.getElementById('produto');
    var selectTipoMidia = document.getElementById('tipo_midia');
    selectTipoMidia.addEventListener('change', async function(e) {
        spinner.exibe();

        if (e.target.value != 0) {
            let formData = new FormData();
            formData.append('tipo_midia_id', e.target.value);

            let verticais = await ajax.fazRequisicao(formData, '/buscar-verticais', 'POST', null)
            
            if (verticais.length) {
                let html = `<option value="0">Selecione</option>`;

                verticais.forEach(vertical => {
                    html += `
                        <option value="${vertical['id']}">${vertical['descricao']}</option>
                    `;
                });

                selectVerticais.innerHTML = html;
                spinner.esconde();
            } else {
                limpaSelects(selectVerticais);
                limpaSelects(selectProdutos);
                spinner.esconde();
            }
        } else {
            limpaSelects(selectVerticais);
            limpaSelects(selectProdutos);
            spinner.esconde();
        }
    }, false);

    selectVerticais.addEventListener('change', async function(e) {
        spinner.exibe();

        if (e.target.value != 0) {
            let formData = new FormData();
            formData.append('vertical_id', e.target.value);

            let produtos = await ajax.fazRequisicao(formData, '/buscar-produtos', 'POST', null)
            
            if (produtos.length) {
                let html = `<option value="0">Selecione</option>`;

                produtos.forEach(vertical => {
                    html += `
                        <option value="${vertical['id']}">${vertical['descricao'] + ' ' + vertical['visual_lar'] + 'x' + vertical['visual_alt']}</option>
                    `;
                });

                selectProdutos.innerHTML = html;
                spinner.esconde();
            } else {
                limpaSelects(selectProdutos);
                spinner.esconde();
            }
        } else {
            limpaSelects(selectProdutos);
            spinner.esconde();
        }
    }, false);

    spinner.esconde();
}

function limpaSelects(select) {
    html = `<option value="">...</option>`;
    select.innerHTML = html;
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

    let arrLargAlt = document.querySelectorAll('#produto')[0].selectedOptions[0].innerText.split(' ')[2].split('x');
    let largura = arrLargAlt[0];
    let altura = arrLargAlt[1];

    let modelo = document.getElementById('div_modelo');
    modelo.style.width = largura.replace('.', '') + 'px';
    modelo.style.height = altura.replace('.', '') + 'px';

    $("#div_modelo").draggable().resizable({
        spectRatio: true
    });

    // let imagem = document.getElementById('imagem_modal');
    // imagem.width = largura.replace('.', '') + 'px';

    document.getElementById('open-modal').click();
}