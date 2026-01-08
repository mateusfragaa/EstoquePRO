const setor = document.getElementById('danger-outlined');
const produto = document.getElementById('success-outlined');
const selectSetor = document.getElementById('selectSetor');

setor.addEventListener('click', () => {
  selectSetor.classList.remove('d-none');
});
produto.addEventListener('click', () => {
  selectSetor.classList.add('d-none');
});
