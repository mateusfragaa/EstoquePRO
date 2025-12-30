document.getElementById('btnVisualizar').addEventListener('click', function () {

    const checkSelecionado = document.querySelector('.row-checkbox:checked');

    if (!checkSelecionado) {
        alert("Selecione um item");
        return;
    }

    const id = checkSelecionado.value;
    window.location.href = `/produto/view/${id}`;
});
