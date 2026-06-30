// ==========================================================
// ASTRAOS - DASHBOARD.JS
// NeoDesk Informática
// ==========================================================

document.addEventListener("DOMContentLoaded", function () {

    iniciarDashboard();
    atualizarSaudacao();
    animarCards();

});

// ==========================================================
// INICIALIZAÇÃO
// ==========================================================

function iniciarDashboard() {
    console.log("Dashboard AstraOS carregado.");
}

// ==========================================================
// SAUDAÇÃO AUTOMÁTICA
// ==========================================================

function atualizarSaudacao() {
    const saudacao = document.getElementById("dashboardGreeting");

    if (!saudacao) {
        return;
    }

    const hora = new Date().getHours();
    let texto = "Olá";

    if (hora >= 5 && hora < 12) {
        texto = "Bom dia";
    } else if (hora >= 12 && hora < 18) {
        texto = "Boa tarde";
    } else {
        texto = "Boa noite";
    }

    saudacao.textContent = texto;
}

// ==========================================================
// ANIMAÇÃO DOS CARDS
// ==========================================================

function animarCards() {
    const cards = document.querySelectorAll(".dashboard-card");

    cards.forEach((card, index) => {
        card.style.opacity = "0";
        card.style.transform = "translateY(16px)";

        setTimeout(() => {
            card.style.transition = ".35s ease";
            card.style.opacity = "1";
            card.style.transform = "translateY(0)";
        }, index * 100);
    });
}

// ==========================================================
// AÇÃO FUTURA: ATUALIZAR DASHBOARD VIA AJAX
// ==========================================================

function atualizarDashboard() {
    console.log("Atualização futura do dashboard via AJAX.");
}