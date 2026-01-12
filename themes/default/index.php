<div id="layout-content">
    <?php
    /*
     * ADAPTADO POR EDSON MORETTI -> www.edsonmoretti.com.br | contato@edsonmoretti.com.br
     * Adaptado por Lucas Pedro -> https://github.com/lucasplcorrea
     * Funciona corretamente no Chrome/Chromium
     * Em caso de uso do m3u, verificar se a extensão m3u permanece ativa e funcionando, do contrário substituir o código da extensão do chrome
     * Para uso no firefox, verificar a possibilidade de integração com extensões do firefox
     */
    // Get the contents of the JSON file 
    if (!file_exists("config.json")) {
        echo 'Arquivo config.json n�o encontrado';
        return;
    }
    $c = file_get_contents("config.json");
// Convert to array 
    $config = json_decode($c, true);
    $tipo = $config['tipo'];
    $videoM3U = $config['videoM3U'];
    switch ($tipo) {
        case 'm3u':
            ?>
            <div id="m3u-container" class="video-container">
            <video id="m3u-video" class="video" autoplay controls>
                <source src="<?php echo $videoM3U; ?>" type="application/x-mpegURL">
                Seu navegador não suporta o elemento de vídeo HTML5.
            </video>
            <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
            <script>
                var video = document.querySelector('.video');
                if (Hls.isSupported()) {
                  var hls = new Hls();
                  hls.loadSource('<?php echo $videoM3U; ?>');
                  hls.attachMedia(video);
                }
            </script>
            </div>
            <?php
            break;
        case 'youtube':
            ?>
            <div id="youtube-container" class="video-container">
            <iframe id="youtube-iframe" class="video" src="<?php echo (isset($config['videoYoutube']) && !empty($config['videoYoutube'])) ? htmlspecialchars($config['videoYoutube']) : 'https://www.youtube.com/embed/wnhvanMdx4s'; ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <?php
            break;
        case 'local':
            ?>
            <div id="local-video-container" class="video-container">
            <iframe id="local-video-iframe" class="video" scrolling="no" src="themes/default/videos/index.php" frameborder="0" ></iframe>
            </div>
            <?php
            break;
    }
    ?>

    <div id="barra-lateral" class="vertical">
        <div id="senha-container"> 
            <div id="mensagem">
                <span>{{ ultima.mensagem }}</span>
            </div>
            <div class="row">
                <div>
                    <div id="senha" class="blink">
                        <span>{{ ultima.texto }}</span>
                        <hr>
                    </div>
                </div>
                <div>
                    <div id="local" class="local">
                        <span>{{ ultima.local }}</span>
                    </div>
                    <div id="local-numero" class="numero-local">
                        <span>{{ ultima.numeroLocal }}</span>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div id="separador"></div>
        <div id="relogio-container">
            <iframe id="relogio" src="themes/default/relogio/index.htm" frameborder="0" scrolling="no" ></iframe>
        </div>
        <div id="logo-container">
            <div id="left-logo" class="logo">
                <img src="<?php echo (isset($config['logoEsquerda']) && !empty($config['logoEsquerda'])) ? htmlspecialchars($config['logoEsquerda']) : 'themes/default/img/logos/logo-gestao-pmg.png'; ?>" alt="Logo">
            </div>
            <div id="separator"></div>
            <div id="right-logo" class="logo">
                <img src="<?php echo (isset($config['logoDireita']) && !empty($config['logoDireita'])) ? htmlspecialchars($config['logoDireita']) : 'themes/default/img/logos/logo-sti-pmg.png'; ?>" alt="Logo">
            </div> 
        </div>
    </div>

    <div id="historico">
        <hr>
        <div class="senhas">
            <div class="col-sm-3 senha-chamada {{ senha.styleClass }} vertical" ng-repeat="senha in historico | limitTo: 4">
                <div class="senha">
                    <span>{{ senha.texto }}</span>
                </div>
                <div class="local">
                    <span>{{ senha.local }}: {{ senha.numeroLocal }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
