const modal = document.getElementById("myModal");
const closeModalButton = document.getElementById("closeModal");
const cancelBtn = document.getElementById("cancelBtn");

// Função para abrir o modal ao carregar a página
window.onload = function() {
    modal.style.display = "block";
}

// Função para fechar o modal
closeModalButton.onclick = function() {
    modal.style.display = "none";
}

// Fechar o modal ao clicar no botão "Fechar"
cancelBtn.onclick = function() {
    modal.style.display = "none";
}

// Fechar o modal se o usuário clicar fora do modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}