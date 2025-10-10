// Script principal para o projeto de signos zodiacais
document.addEventListener('DOMContentLoaded', function() {
    
    // Criar efeito de partículas
    createParticles();
    
    // Validação do formulário
    const form = document.getElementById('zodiacForm');
    if (form) {
        form.addEventListener('submit', validateForm);
    }
    
    // Efeitos de animação nos cards
    animateCards();
    
    // Efeito de digitação no título (se estiver na página de resultado)
    const signoNome = document.querySelector('.signo-nome');
    if (signoNome) {
        typeWriter(signoNome, signoNome.textContent, 100);
    }
    
    // Smooth scroll para links internos
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Função para criar partículas flutuantes
function createParticles() {
    const particlesContainer = document.getElementById('particles');
    if (!particlesContainer) return;
    
    const particleCount = 50;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        // Posição aleatória
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        
        // Tamanho aleatório
        const size = Math.random() * 4 + 2;
        particle.style.width = size + 'px';
        particle.style.height = size + 'px';
        
        // Animação aleatória
        const duration = Math.random() * 10 + 5;
        particle.style.animationDuration = duration + 's';
        particle.style.animationDelay = Math.random() * 5 + 's';
        
        particlesContainer.appendChild(particle);
    }
}

// Validação do formulário
function validateForm(e) {
    const dataInput = document.getElementById('data_nascimento');
    const data = new Date(dataInput.value);
    const hoje = new Date();
    
    // Verificar se a data é válida
    if (data > hoje) {
        e.preventDefault();
        showAlert('Por favor, selecione uma data de nascimento válida.', 'warning');
        return false;
    }
    
    // Verificar se a data não é muito antiga (mais de 150 anos)
    const idade = hoje.getFullYear() - data.getFullYear();
    if (idade > 150) {
        e.preventDefault();
        showAlert('Por favor, selecione uma data de nascimento mais recente.', 'warning');
        return false;
    }
    
    // Adicionar efeito de loading
    const button = e.target.querySelector('button[type="submit"]');
    if (button) {
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Descobrindo...';
        button.disabled = true;
    }
    
    return true;
}

// Função para mostrar alertas
function showAlert(message, type = 'info') {
    // Remover alertas existentes
    const existingAlert = document.querySelector('.custom-alert');
    if (existingAlert) {
        existingAlert.remove();
    }
    
    const alert = document.createElement('div');
    alert.className = `custom-alert alert-${type}`;
    alert.innerHTML = `
        <div class="alert-content">
            <i class="fas fa-${getAlertIcon(type)} me-2"></i>
            ${message}
            <button type="button" class="btn-close" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Adicionar estilos
    alert.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        z-index: 9999;
        background: ${getAlertColor(type)};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        animation: slideInRight 0.3s ease-out;
        max-width: 400px;
    `;
    
    document.body.appendChild(alert);
    
    // Remover automaticamente após 5 segundos
    setTimeout(() => {
        if (alert.parentElement) {
            alert.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => alert.remove(), 300);
        }
    }, 5000);
}

// Funções auxiliares para alertas
function getAlertIcon(type) {
    const icons = {
        'success': 'check-circle',
        'warning': 'exclamation-triangle',
        'error': 'times-circle',
        'info': 'info-circle'
    };
    return icons[type] || 'info-circle';
}

function getAlertColor(type) {
    const colors = {
        'success': 'linear-gradient(135deg, #28a745, #20c997)',
        'warning': 'linear-gradient(135deg, #ffc107, #fd7e14)',
        'error': 'linear-gradient(135deg, #dc3545, #e83e8c)',
        'info': 'linear-gradient(135deg, #17a2b8, #6f42c1)'
    };
    return colors[type] || colors.info;
}

// Animação dos cards
function animateCards() {
    const cards = document.querySelectorAll('.zodiac-card, .result-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });
    
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.8s ease-out';
        observer.observe(card);
    });
}

// Efeito de digitação
function typeWriter(element, text, speed) {
    element.textContent = '';
    let i = 0;
    
    function type() {
        if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
            setTimeout(type, speed);
        }
    }
    
    type();
}

// Efeito parallax suave no scroll
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelector('.particles');
    
    if (parallax) {
        const speed = scrolled * 0.5;
        parallax.style.transform = `translateY(${speed}px)`;
    }
});

// Adicionar estilos CSS dinâmicos para animações
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .alert-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .btn-close {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 0;
        margin-left: 1rem;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }
    
    .btn-close:hover {
        opacity: 1;
    }
    
    .custom-alert {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
    }
`;
document.head.appendChild(style);
