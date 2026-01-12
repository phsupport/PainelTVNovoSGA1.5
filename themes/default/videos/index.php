<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../style.css" />
<!--        <style type="text/css">
            html,
            body {
                height: 100%;
                width: 100%;
            }
            .container {
                display: flex;
                height: 98%;
                width: 99%;
            }
        </style>-->
    </head>
    <body>
        <video id="tvOlinda" autoplay width="100%" height="100%" muted playsinline preload="metadata" style="background:black">
            <?php
            // Prefer local 'videos' directory relative to this file
            $fsDir = realpath(__DIR__ . '/videos2');
            $webDir = 'videos2/';

            // If local doesn't exist, fallback to project-level 'arquivos'
            if ($fsDir === false || !is_dir($fsDir)) {
                $fsDir = realpath(__DIR__ . '/../../../arquivos');
                $webDir = '../../../arquivos/';
            }

            $items = array();
            if ($fsDir && is_dir($fsDir)) {
                $files = scandir($fsDir);
                foreach ($files as $f) {
                    if (preg_match('/\.mp4$/i', $f)) {
                        $items[] = $f;
                    }
                }
                // Natural case-insensitive sort
                natcasesort($items);
                $items = array_values($items);
            }

            if (count($items) > 0) {
                foreach ($items as $i => $nomeArquivo) {
                    $cls = ($i === 0) ? 'active' : '';
                    $src = $webDir . $nomeArquivo;
                    echo '<source data-index="'. $i .'" class="'. $cls .'" src="'. htmlspecialchars($src, ENT_QUOTES) .'" type="video/mp4">' . PHP_EOL;
                }
            }
            ?>
        </video> 
        <p id="noVideos" style="display:none;color:white;text-align:center;margin-top:0.5rem;">Nenhum vídeo encontrado no diretório configurado.</p>
        <script src="script-playlist.js"></script>
    </body>

</html>
