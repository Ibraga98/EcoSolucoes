// Exemplo de validação de formulário
function validateForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (!username || !password) {
        alert('Preencha todos os campos!');
        return false;
    }
    return true;
}
