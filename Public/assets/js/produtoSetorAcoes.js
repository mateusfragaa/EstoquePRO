// Função auxiliar para obter o ID selecionado

function getSelectedId() {
    const checkSelecionado = document.querySelector('.row-checkbox:checked');
    if (!checkSelecionado) {
        alert("Selecione um item");
        return null;
    }
    
    console.log(checkSelecionado);
    return checkSelecionado.value;
}

// Evento para Visualizar
document.getElementById('btnEstoqueVisualizar').addEventListener('click', function () {
    const id = getSelectedId();
    if (id) window.location.href = `/estoque/view/${id}`;
});

// Evento para Editar
document.getElementById('btnEstoqueEditar').addEventListener('click', function () {
    const id = getSelectedId();
    if (id) window.location.href = `/estoque/edicao/${id}`;
});

// Evento para Excluir
document.getElementById('btnEstoqueExcluir').addEventListener('click', function () {
    const id = getSelectedId();
    if (id) window.location.href = `/estoque/exclusao/${id}`;
});

