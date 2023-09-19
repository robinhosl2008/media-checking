window.onload = function() {
    let tabela = document.getElementById('myTable');

    if (tabela)
        new DataTable('#myTable', {
            searching: false,
            ordering:  false
        });

    let alertDanger = document.querySelector('div.alert.alert-danger li');

    if (alertDanger) 
        exibeErroInput(alertMessageId);
        

    let inputs = document.querySelectorAll('form input.form-control');

    if (inputs) {
        inputs.forEach(element => {
            element.addEventListener('click', function() {
                removeErroInput(this);
            });
        });
    }
}

function exibeErroInput(inputId) {
    let input = document.getElementById(inputId),
        inputErrorMessage = input.parentElement.querySelector('p.erro-input');

    input.classList.add('erro-input');
    inputErrorMessage.style.display = 'block';
}

function removeErroInput(input) {
    let inputErrorMessage = input.parentElement.querySelector('p.erro-input');

    if (inputErrorMessage) {
        let messageDiv = document.querySelector('.alert.alert-danger');

        if (messageDiv)
            messageDiv.style.display = 'none';
        
        input.classList.remove('erro-input');
        inputErrorMessage.style.display = 'none';
    }
}