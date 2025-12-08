
document.addEventListener('DOMContentLoaded', function() {
    
    const formDoce = document.querySelector('.form-doce');
    
    if (formDoce) {
        formDoce.addEventListener('submit', function(e) {
            const nome = document.getElementById('nome').value.trim();
            const tipo = document.getElementById('tipo').value;
            const quantidade = document.getElementById('quantidade').value;
            
            if (nome === '') {
                e.preventDefault();
                alert('Por favor, preencha o nome do doce!');
                document.getElementById('nome').focus();
                return false;
            }
            
            if (tipo === '') {
                e.preventDefault();
                alert('Por favor, selecione o tipo do doce!');
                document.getElementById('tipo').focus();
                return false;
            }
            
            if (quantidade === '' || quantidade < 1) {
                e.preventDefault();
                alert('Por favor, informe uma quantidade válida (maior que 0)!');
                document.getElementById('quantidade').focus();
                return false;
            }
        });
    }
    
    const messages = document.querySelectorAll('.success-message, .error-message');
    messages.forEach(function(message) {
        setTimeout(function() {
            message.style.transition = 'opacity 0.5s';
            message.style.opacity = '0';
            setTimeout(function() {
                message.remove();
            }, 500);
        }, 5000);
    });
    
    const botoesExcluir = document.querySelectorAll('.btn-excluir');
    botoesExcluir.forEach(function(botao) {
        botao.addEventListener('click', function(e) {
            if (!confirm('Tem certeza que deseja excluir este doce? Esta ação não pode ser desfeita.')) {
                e.preventDefault();
                return false;
            }
        });
    });
    
    const inputQuantidade = document.getElementById('quantidade');
    if (inputQuantidade) {
        inputQuantidade.addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });
    }
    
    const primeiroInput = document.querySelector('input[type="text"], input[type="password"]');
    if (primeiroInput && !primeiroInput.value) {
        primeiroInput.focus();
    }
});

function confirmarExclusao(cod_doce) {
    if (confirm('Tem certeza que deseja excluir este doce? Esta ação não pode ser desfeita.')) {
        window.location.href = 'excluir_doce.php?id=' + cod_doce;
    }
}   