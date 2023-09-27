const ajax = new Ajax();
const spinner = new Spinner();
const divImagem = document.querySelector('.div_imagem');
const divModelo = document.querySelector('.div_modelo');
const elemFile = document.getElementById('arquivo');

var image = null;
var image_src = null;
var largura = null;
var altura = null;
var scale = 1;
var elemArquivo = null;

spinner.exibe();

window.onload = function() {
    elemArquivo = document.getElementById('arquivo');
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
        carregaImagem();
        validarFormulario();
    });

    divImagem.onwheel = zoom;
    divModelo.onwheel = zoom;

    spinner.esconde();
}

function carregaImagem() {
    if (elemFile.files && elemFile.files[0]) {
        var file = new FileReader();
        file.onload = function (e) {
            validarFormulario(e);
        };
        file.readAsDataURL(elemFile.files[0]);
    }
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
    // document.querySelector('.info-midia').style.display = 'none';
    document.querySelector('.div_imagem').src = '';
}

async function validarFormulario(e) {
    var tipoMidia = document.getElementById('tipo_midia').value,
        vertical = document.getElementById('vertical').value,
        produto = document.getElementById('produto').value,
        arquivo = document.getElementById('arquivo');

    if (tipoMidia == 0 || vertical == 0 || produto == 0 || (!arquivo.files && !arquivo.files[0])) {
        exibirAlertaDeInput('warning', 'Todos os campos são obrigatórios para exibir o preview.');
        return;
    }

    if (e) {
        let divImagem = document.querySelector('.div_imagem');
        let divVideo = document.querySelector('.div_video');

        if (e.target.result) {
            if (e.target.result.includes('pdf')) {
                var url = URL.createObjectURL(arquivo.files[0]); // Substitua pelo caminho do seu arquivo PDF
                var pdfjsLib = window['pdfjs-dist/build/pdf'];

                pdfjsLib.GlobalWorkerOptions.workerSrc = 'js/pdfjs-3.11.174/build/pdf.worker.js';

                // Carrega o PDF usando PDF.js
                pdfjsLib.getDocument(url).promise.then(function(pdf) {
                    // Renderiza a página
                    pdf.getPage(1).then(function(page) {
                        var canvas = document.createElement('canvas');
                        var context = canvas.getContext('2d');
                        var viewport = page.getViewport({ scale: 1.5 });

                        // Define as dimensões do canvas de acordo com a página
                        canvas.width = viewport.width;
                        canvas.height = viewport.height;

                        // Adicione o canvas ao DOM
                        document.querySelector('.div_imagem').appendChild(canvas);

                        // Renderiza a página no canvas
                        page.render({ canvasContext: context, viewport: viewport });
                    });
                });

                // let formData = new FormData();
                // formData.append('file', arquivo.files[0]);

                // await ajax.fazRequisicao(formData, '/buscar-path-arquivo', 'POST', callback);
                
                // divImagem.src = e.target.result;

                // divVideo.style.display = 'none';
                // divImagem.style.display = 'block';

                setTimeout(function() {
                    let preview = document.querySelector('.div_imagem');
                    let textoTamanhoOriginal = preview.naturalWidth + 'x' + preview.naturalHeight;
                    document.querySelector('.nome_arquivo').innerText = elemArquivo.files[0].name;
                    document.querySelector('.tamanho_arquivo').innerText = textoTamanhoOriginal;
                }, 1000);
            } else if (e.target.result.includes('video')) {
                let videoType = document.querySelector('input[type="file"]').files[0].type;

                document.querySelector(`source[type="${videoType}"]`).src = e.target.result;
                document.querySelector(`#my-player_html5_api`).src = e.target.result;

                let divVideoDimension = document.querySelector('.my-player-dimensions');
                divVideoDimension.style.width = '100%';
                divVideoDimension.style.height = '100%';

                divImagem.style.display = 'none !important';
                divVideo.style.display = 'block';
                divVideo.style.position = 'inherit';

                let formData = new FormData();
                formData.append('file', document.querySelector('#arquivo').files[0]);

                let callback = function(data = null) {
                    if (data) {
                        setTimeout(function() {
                            let textoTamanhoOriginal = data.largura + 'x' + data.altura;
                            document.querySelector('.nome_arquivo').innerText = elemArquivo.files[0].name;
                            document.querySelector('.tamanho_arquivo').innerText = textoTamanhoOriginal;
                            // document.querySelector('.info-midia').style.display = 'block';
                        }, 1000);
                    }
                };

                await ajax.fazRequisicao(formData, '/buscar-resolucao', 'POST', callback);
            }

            // document.querySelector('.info-midia').style.display = 'block';
        }
    } else {
        // document.querySelector('.info-midia').style.display = 'none';
    }

    let arrAux = document.querySelectorAll('#produto')[0].selectedOptions[0].innerText.split(' ');
    let arrLargAlt = document.querySelectorAll('#produto')[0].selectedOptions[0].innerText.split(' ')[arrAux.length - 1].split('x');
    var largura = arrLargAlt[0];
    var altura = arrLargAlt[1];

    let modelo = document.querySelector('.div_modelo');
    modelo.style.width = largura.replace('.', '') + 'px';
    modelo.style.height = altura.replace('.', '') + 'px';
    modelo.style.padding = '0px';
    modelo.style.display = 'block';

    let div = document.querySelector('.div_imagem');
    // div.style.width = largura.replace('.', '') + 'px';
    // div.style.height = altura.replace('.', '') + 'px';
    div.style.padding = '0px';
    div.style.display = 'block';

    // let imagem = document.getElementById('imagem_modal');
    // imagem.style.width = largura.replace('.', '') + 'px';
    
    $('#div_layout').draggable();
}