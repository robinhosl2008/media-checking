class Confirm {
    constructor() {}

    exibeModalConfirme(msg, callback) {
        let contentMsg = document.querySelector('.modal-body'),
            btnSim = document.querySelector('.btn-sim');

        contentMsg.innerText = msg;
        btnSim.addEventListener('click', function() {
            callback.submit();
        });

        console.log(msg)
    }
}