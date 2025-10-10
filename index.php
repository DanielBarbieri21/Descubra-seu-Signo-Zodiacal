<?php include('layouts/header.php'); ?>

<!-- Efeito de partículas -->
<div class="particles" id="particles"></div>

<div class="main-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="zodiac-card fade-in-up">
                    <!-- Header do card -->
                    <div class="card-header-custom">
                        <h2><i class="fas fa-star me-3"></i>Descubra seu Signo Zodiacal</h2>
                        <p class="subtitle">Explore os mistérios do universo através da astrologia</p>
                    </div>
                    
                    <!-- Formulário -->
                    <div class="form-container">
                        <form method="POST" action="show_zodiac_sign.php" id="zodiacForm">
                            <div class="mb-4">
                                <label for="data_nascimento" class="form-label">
                                    <i class="fas fa-calendar-alt me-2"></i>Data de Nascimento
                                </label>
                                <input type="date" 
                                       name="data_nascimento" 
                                       id="data_nascimento" 
                                       class="form-control" 
                                       required
                                       max="<?php echo date('Y-m-d'); ?>">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Selecione sua data de nascimento para descobrir seu signo
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary-custom w-100">
                                <i class="fas fa-magic me-2"></i>Descobrir Meu Signo
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Seção informativa -->
                <div class="row mt-5">
                    <div class="col-md-4 mb-4">
                        <div class="text-center text-white">
                            <div class="mb-3">
                                <i class="fas fa-moon fa-3x"></i>
                            </div>
                            <h5>Astrologia</h5>
                            <p class="small">Conheça a influência dos astros em sua personalidade</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="text-center text-white">
                            <div class="mb-3">
                                <i class="fas fa-star fa-3x"></i>
                            </div>
                            <h5>Signos</h5>
                            <p class="small">Descubra as características únicas do seu signo</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="text-center text-white">
                            <div class="mb-3">
                                <i class="fas fa-heart fa-3x"></i>
                            </div>
                            <h5>Personalidade</h5>
                            <p class="small">Entenda melhor seus traços de personalidade</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>

</body>
</html>
