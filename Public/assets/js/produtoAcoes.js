// Função auxiliar para obter o ID selecionado
function getSelectedId() {
    const checkSelecionado = document.querySelector('.row-checkbox:checked');
    
    if (!checkSelecionado) {
        alert("Selecione um item");
        return null;
    }
    
    return checkSelecionado.value;
}

// Evento para Visualizar
document.getElementById('btnProdutoVisualizar').addEventListener('click', function () {
    const id = getSelectedId();
    if (id) window.location.href = `/produto/view/${id}`;
});

// Evento para Editar
document.getElementById('btnProdutoEditar').addEventListener('click', function () {
    const id = getSelectedId();
    if (id) window.location.href = `/produto/edicao/${id}`;
});

// Evento para Excluir
document.getElementById('btnProdutoExcluir').addEventListener('click', function () {
    const id = getSelectedId();
    if (id) window.location.href = `/produto/exclusao/${id}`;
});