<?php include('layouts/header.php'); ?>

<!-- Efeito de partículas -->
<div class="particles" id="particles"></div>

<div class="result-container">
<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
    <?php
    if (isset($_POST['data_nascimento'])) {
        $dataNascimento = DateTime::createFromFormat('Y-m-d', $_POST['data_nascimento']);
        $signos = simplexml_load_file('signos.xml');
        $signoEncontrado = null;

        foreach ($signos->signo as $signo) {
            $inicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio);
            $fim = DateTime::createFromFormat('d/m', (string)$signo->dataFim);

            // Colocar o mesmo ano da data de nascimento
            $inicio->setDate((int)$dataNascimento->format('Y'), (int)$inicio->format('m'), (int)$inicio->format('d'));
            $fim->setDate((int)$dataNascimento->format('Y'), (int)$fim->format('m'), (int)$fim->format('d'));

            // Ajuste para signos que cruzam o ano (ex: Capricórnio)
            if ($fim < $inicio) {
                $fim->modify('+1 year');
            }

            if ($dataNascimento >= $inicio && $dataNascimento <= $fim) {
                $signoEncontrado = $signo;
                break;
            }
        }

        if ($signoEncontrado) {
                        // Mapear emojis para cada signo
                        $emojis = [
                            'Áries' => '♈',
                            'Touro' => '♉',
                            'Gêmeos' => '♊',
                            'Câncer' => '♋',
                            'Leão' => '♌',
                            'Virgem' => '♍',
                            'Libra' => '♎',
                            'Escorpião' => '♏',
                            'Sagitário' => '♐',
                            'Capricórnio' => '♑',
                            'Aquário' => '♒',
                            'Peixes' => '♓'
                        ];
                        
                        $emoji = $emojis[(string)$signoEncontrado->signoNome] ?? '⭐';
                        $dataFormatada = $dataNascimento->format('d/m/Y');
                        
                        echo "<div class='result-card fade-in-up'>";
                        echo "<span class='signo-emoji'>{$emoji}</span>";
                        echo "<h1 class='signo-nome'>{$signoEncontrado->signoNome}</h1>";
                        echo "<p class='signo-descricao'>{$signoEncontrado->descricao}</p>";
                        echo "<div class='row mt-4'>";
                        echo "<div class='col-md-6'>";
                        echo "<div class='info-box'>";
                        echo "<h6><i class='fas fa-calendar me-2'></i>Data de Nascimento</h6>";
                        echo "<p>{$dataFormatada}</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='col-md-6'>";
                        echo "<div class='info-box'>";
                        echo "<h6><i class='fas fa-star me-2'></i>Período</h6>";
                        echo "<p>{$signoEncontrado->dataInicio} - {$signoEncontrado->dataFim}</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        
                        // Card adicional com características
                        echo "<div class='result-card fade-in-up mt-4'>";
                        echo "<h4><i class='fas fa-magic me-2'></i>Características do Signo</h4>";
                        echo "<div class='row mt-3'>";
                        echo "<div class='col-md-3 text-center mb-3'>";
                        echo "<div class='characteristic-box'>";
                        echo "<i class='fas fa-fire fa-2x mb-2'></i>";
                        echo "<h6>Elemento</h6>";
                        echo "<p class='small'>" . (string)$signoEncontrado->elemento . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='col-md-3 text-center mb-3'>";
                        echo "<div class='characteristic-box'>";
                        echo "<i class='fas fa-gem fa-2x mb-2'></i>";
                        echo "<h6>Qualidade</h6>";
                        echo "<p class='small'>" . (string)$signoEncontrado->qualidade . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='col-md-3 text-center mb-3'>";
                        echo "<div class='characteristic-box'>";
                        echo "<i class='fas fa-globe fa-2x mb-2'></i>";
                        echo "<h6>Planeta</h6>";
                        echo "<p class='small'>" . (string)$signoEncontrado->planeta . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='col-md-3 text-center mb-3'>";
                        echo "<div class='characteristic-box'>";
                        echo "<i class='fas fa-palette fa-2x mb-2'></i>";
                        echo "<h6>Cor</h6>";
                        echo "<p class='small'>" . (string)$signoEncontrado->cor . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='row mt-3'>";
                        echo "<div class='col-md-6 text-center mb-3'>";
                        echo "<div class='characteristic-box'>";
                        echo "<i class='fas fa-gem fa-2x mb-2'></i>";
                        echo "<h6>Pedra</h6>";
                        echo "<p class='small'>" . (string)$signoEncontrado->pedra . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='col-md-6 text-center mb-3'>";
                        echo "<div class='characteristic-box'>";
                        echo "<i class='fas fa-star fa-2x mb-2'></i>";
                        echo "<h6>Características</h6>";
                        echo "<p class='small'>" . (string)$signoEncontrado->caracteristicas . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        
        } else {
                        echo "<div class='result-card fade-in-up'>";
                        echo "<div class='text-center'>";
                        echo "<i class='fas fa-exclamation-triangle fa-4x text-warning mb-3'></i>";
                        echo "<h3>Signo não encontrado</h3>";
                        echo "<p>Não foi possível determinar seu signo com a data informada.</p>";
                        echo "</div>";
                        echo "</div>";
        }
    } else {
                    echo "<div class='result-card fade-in-up'>";
                    echo "<div class='text-center'>";
                    echo "<i class='fas fa-exclamation-circle fa-4x text-danger mb-3'></i>";
                    echo "<h3>Data não informada</h3>";
                    echo "<p>Por favor, volte e informe sua data de nascimento.</p>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
                
    <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-secondary-custom">
                        <i class="fas fa-arrow-left me-2"></i>Voltar ao Início
                    </a>
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
