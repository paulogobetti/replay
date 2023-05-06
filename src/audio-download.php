<?php

/*

    --no-check-certificate      Ignorar checagem de SSL.
    -x                          Extrair o áudio apenas.
    --audio-format mp3          Setando mp3 como formato.
    --audio-quality 320K        Setando bitrate para 320Kbps.
    --add-metadata              Adicionar metadata ao arquivo de áudio.
    --embed-thumbnail           Inserir thumbnail no arquivo de áudio.
    --ffmpeg-location DIR       Indicando o caminho do ffmpeg // Assim é possível utilizar localmente, sem a necessidade de elevar privilégios para libs do sistema.
    -o                          Personalizar o arquivo e diretório de saída.

*/

    // $command = "cd .cache && ls";

    $url = $_POST['url'];

    $command = "includes/youtube-dl --cache-dir .cache --no-check-certificate -x --audio-format mp3 --audio-quality 320K --add-metadata --embed-thumbnail --write-thumbnail --ffmpeg-location includes/ffmpeg-*/ffmpeg -o '../app/media/%(artist)s - %(title)s [%(album)s - %(release_year)s].%(ext)s' " . $url . " 2>&1";

    echo "<pre>$command</pre>";

    $getFile = shell_exec($command);
    echo "<pre>$getFile</pre>";
