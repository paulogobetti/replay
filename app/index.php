<?php?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePlay</title>
</head>
<body>
    <nav>
        <a href="index.html">Home</a> <br>
        <a href="playlists.html">Playlists</a> <br>
        <a href="youtube-dl.html">Music Downloader</a> <br>
        <a href="tag-editor.html">Music Editor</a>
    </nav>
    <?php
        $path = '/opt/lampp/htdocs/replay/app/media';
        $dir = dir($path);

        // Listagem dinâmica dos arquivos.
        // Caso não dê para listar tudo dinamicamente lendo as metatags, alterar para formato JSON e renderizar com JS.
        while($musicFile = $dir->read()){
            if($musicFile != '..' && $musicFile != '.'){
                echo "
                <figure>
                    <figcaption>$musicFile</figcaption>
                    <audio controls src='http://localhost/replay/app/media/$musicFile'>
                </figure>
                ";
            }
        }
        $dir->close();
    ?>
</body>
</html>
