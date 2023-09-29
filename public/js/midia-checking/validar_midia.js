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

    // divModelo.onwheel = zoom;
    // $('.div_modelo').draggable({
    //     drag: function(event, ui) {
    //         var divPai = $(this).parent();
    //         var limiteEsquerda = 0;
    //         var limiteTopo = 0;
    //         var limiteDireita = divPai.width() - $(this).width();
    //         var limiteBase = divPai.height() - $(this).height();

    //         // Ajusta a posição para garantir que a div filha não ultrapasse os limites da div pai
    //         ui.position.left = Math.min(limiteDireita, Math.max(limiteEsquerda, ui.position.left));
    //         ui.position.top = Math.min(limiteBase, Math.max(limiteTopo, ui.position.top));
            
    //         // Limita a largura e altura da div filha
    //         var novaLargura = Math.min(divPai.width(), $(this).width());
    //         var novaAltura = Math.min(divPai.height(), $(this).height());
            
    //         $(this).width(novaLargura);
    //         $(this).height(novaAltura);
    //     }
    // });

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

    let arrAux = document.querySelectorAll('#produto')[0].selectedOptions[0].innerText.split(' ');
    let arrLargAlt = document.querySelectorAll('#produto')[0].selectedOptions[0].innerText.split(' ')[arrAux.length - 1].split('x');
    var largura = arrLargAlt[0];
    var altura = arrLargAlt[1];

    if (e) {
        let divImagem = document.querySelector('.div_imagem');
        let divVideo = document.querySelector('.div_video');

        if (e.target.result) {
            if (e.target.result.includes('pdf')) {
                if (divVideo) {
                    divVideo.style.display = 'none';
                    divVideo.innerHTML = '';
                }

                if (divImagem) {
                    divImagem.style.display = 'block';
                    divImagem.innerHTML = '';
                }

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

                let formData = new FormData();
                formData.append('file', arquivo.files[0]);

                let infoPdf = await ajax.fazRequisicao(formData, '/buscar-info-arquivo-pdf', 'POST');
                console.log(infoPdf);

                setTimeout(function() {
                    document.querySelector('.nome_arquivo').innerText = elemArquivo.files[0].name;
                    document.querySelector('.nome_arquivo').setAttribute('title', elemArquivo.files[0].name);
                    
                    document.querySelector('.tamanho_mb').innerText = infoPdf.propriedades.tamanho + 'MB';

                    let textoTamanhoOriginal = infoPdf.propriedades.largura + ' x ' + infoPdf.propriedades.altura;
                    document.querySelector('.tamanho_arquivo').innerText = textoTamanhoOriginal;

                    let textoTamanhoRequerido = parseInt(largura.replace('.', '')) + ' x ' + parseInt(altura.replace('.', ''));
                    document.querySelector('.tamanho_requerido').innerText = textoTamanhoRequerido;
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
        }
    }

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

    obterEscalaAtual(divModelo);
}

// Função para obter a escala atual da div
function obterEscalaAtual(divModelo) {
    var l = divModelo.offsetWidth;
    var a = divModelo.offsetHeight;
    var divPai = 0;
    var originalDaDivModelo = 0;

    if (l > a) {
        // Obtenha a largura da div pai
        divPai = divModelo.parentNode.offsetWidth - 30;

        // Obtenha a largura original da div modelo
        originalDaDivModelo = divModelo.offsetWidth;
    } else {
        // Obtenha a altura da div pai
        divPai = divModelo.parentNode.offsetHeight - 30;

        // Obtenha a altura original da div modelo
        originalDaDivModelo = divModelo.offsetHeight;
    }

    // Calcule a escala necessária
    var scale = divPai / originalDaDivModelo;

    // Aplique a transformação de escala à divModelo
    divModelo.style.transform = `scale(${scale})`;
}