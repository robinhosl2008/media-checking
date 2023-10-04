let area_lar = document.getElementById('area_lar');
    area_alt = document.getElementById('area_alt'),
    visual_lar = document.getElementById('visual_lar'),
    visual_alt = document.getElementById('visual_alt');

let arrDecimalInput = document.querySelectorAll('.aplay-decimal-mask');
arrDecimalInput.forEach(function(elem) {
    addDecimalMask(elem.id);

    elem.addEventListener('focusout', function() {
        toDecimal(elem);
    });
});

function addDecimalMask(elemId) {
    $(`#${elemId}`).mask("##0.00", { reverse: true });
}

function toDecimal(elem) {
    let value = parseFloat(elem.value).toFixed(2);
    if (isNaN(value)) {
        value = 0;
    }

    elem.value = value;
}

