const ajax = new Ajax();
const spinner = new Spinner();
const divImagem = document.querySelector('#div_imagem');
const divModelo = document.getElementById('div_modelo');
const elemFile = document.getElementById('arquivo');

var image = null;
var image_src = null;
var largura = null;
var altura = null;
var scale = 1;

spinner.exibe();

window.onload = function() {
    var elemArquivo = document.getElementById('arquivo');
    elemArquivo.addEventListener('change', function() {
        if (elemFile.files && elemFile.files[0]) {
            carregaImagem();
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
                limpaSelects(selectProdutos);
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

        divImagem.style.display = 'none';
        divModelo.style.display = 'none';
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
                        <option value="${vertical['id']}">${vertical['descricao'] + ' ' + 
                        ((selectTipoMidia.value == 1) ? vertical['visual_lar'] : Math.trunc(vertical['visual_lar'])) + 'x' + 
                        ((selectTipoMidia.value == 1) ? vertical['visual_alt'] : Math.trunc(vertical['visual_alt']))}</option>
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

        divImagem.style.display = 'none';
        divModelo.style.display = 'none';
    }, false);

    selectProdutos.addEventListener('change', function() {
        if (elemFile.files && !elemFile.files.length) {
            document.getElementById('imagem_modal').src = '';
            document.getElementById('my-player').src = '';
            document.getElementById('my-player').poster = '';
        } else {
            carregaImagem();
        }

        validarFormulario();
    });

    divImagem.onwheel = zoom;
    divModelo.onwheel = zoom;

    spinner.esconde();
}

function carregaImagem() {
    var file = new FileReader();
    file.onload = function (e) {
        validarFormulario(e);
    };
    file.readAsDataURL(elemFile.files[0]);
}

function zoom(event) {
    event.preventDefault();
    scale += event.deltaY * -0.001;

    // Restrict scale
    scale = Math.min(Math.max(0.125, scale), 4);

    // Apply scale transform
    divImagem.style.transform = `scale(${scale})`;
    divModelo.style.transform = `scale(${scale})`;
}

function limpaSelects(select) {
    html = `<option value="">...</option>`;
    select.innerHTML = html;
}

function validarFormulario(e) {
    var tipoMidia = document.getElementById('tipo_midia').value,
        vertical = document.getElementById('vertical').value,
        produto = document.getElementById('produto').value,
        arquivo = document.getElementById('arquivo');

    if (tipoMidia == 0 || vertical == 0 || produto == 0 || (!arquivo.files && !arquivo.files[0])) {
        exibirAlertaDeInput('warning', 'Todos os campos são obrigatórios para exibir o preview.');
        return;
    }

    if (e) {
        let imageModal = document.getElementById('imagem_modal');
        let myPlayer = document.getElementById('my-player');

        if (e.target.result.includes('image')) {
            imageModal.src = e.target.result;

            myPlayer.style.display = 'none';
            imageModal.style.display = 'block';
        } else if (e.target.result.includes('video')) {
            let videoType = document.querySelector('input[type="file"]').files[0].type;

            document.querySelector(`source[type="${videoType}"]`).src = e.target.result;
            document.querySelector(`#my-player_html5_api`).src = e.target.result;

            let myPlayerDimension = document.querySelector('.my-player-dimensions');
            myPlayerDimension.style.width = '100%';
            myPlayerDimension.style.height = '100%';

            imageModal.style.display = 'none';
            myPlayer.style.display = 'block';
            myPlayer.style.position = 'inherit';
        }
    }

    let arrAux = document.querySelectorAll('#produto')[0].selectedOptions[0].innerText.split(' ');
    let arrLargAlt = document.querySelectorAll('#produto')[0].selectedOptions[0].innerText.split(' ')[arrAux.length - 1].split('x');
    var largura = arrLargAlt[0];
    var altura = arrLargAlt[1];

    let modelo = document.getElementById('div_modelo');
    modelo.style.width = largura.replace('.', '') + 'px';
    modelo.style.height = altura.replace('.', '') + 'px';
    modelo.style.padding = '0px';
    modelo.style.display = 'block';

    let div = document.querySelector('#div_imagem');
    div.style.width = largura.replace('.', '') + 'px';
    div.style.height = altura.replace('.', '') + 'px';
    div.style.padding = '0px';
    div.style.display = 'block';

    let imagem = document.getElementById('imagem_modal');
    imagem.style.width = largura.replace('.', '') + 'px';
    
    $('#div_layout').draggable();
}