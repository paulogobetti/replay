<?php

/*

    --cache-dir .cache          Setar diretório de cache.
    --no-check-certificate      Ignorar checagem de SSL.
    --no-continue               Parar processo caso alguma informação seja perdida.
    -x                          Extrair o áudio apenas.
    --audio-format mp3          Setar formato de saída mp3.
    --audio-quality 320K        Setar bitrate para 320Kbps.
    --add-metadata              Adicionar metadata ao arquivo de áudio (ffmpeg).
    --embed-thumbnail           Inserir thumbnail no arquivo de áudio.
    --write-thumbnail           Salvar arquivo thumbnail.
    --ffmpeg-location DIR       Caminho do ffmpeg // Binário local, sem a necessidade de elevar privilégios para libs do sistema.
    -o                          Personalizar o arquivo e diretório de saída.

*/

    $url = $_POST['url'];

    $getFileCommand = "includes/youtube-dl --cache-dir .cache --no-check-certificate --no-continue -x --audio-format mp3 --audio-quality 320K --add-metadata --embed-thumbnail --write-thumbnail --ffmpeg-location includes/ffmpeg-*/ffmpeg -o '../app/media/%(artist)s - %(track)s - %(album)s - %(release_year)s.%(ext)s' " . $url . " 2>&1";
    echo "<pre>$getFileCommand</pre>";
    $getFile = shell_exec($getFileCommand);
    echo "<pre>$getFile</pre>";

    $getMusicInfoCommand = 'youtube-dl --cache-dir .cache --no-check-certificate --get-filename ' . $url . ' -o "%(track)s#%(artist)s#%(album)s#%(release_year)s#%(duration)s" 2>&1';
    $getFileNameCommand  = 'youtube-dl --cache-dir .cache --no-check-certificate --get-filename ' . $url . ' -o "%(artist)s - %(track)s - %(album)s - %(release_year)s" 2>&1';

    $getMusicInfo = shell_exec($getMusicInfoCommand);
    $getFileName = shell_exec($getFileNameCommand);

    $fileName = trim($getFileName);
    $musicInfo = explode('#', $getMusicInfo);

    $track = $musicInfo[0];
    $artist = $musicInfo[1];
    $album = $musicInfo[2];
    $releaseYear = $musicInfo[3];
    $duration = $musicInfo[4];

    $musicFile = new stdClass;
    $musicFile->track_id = uniqid();
    $musicFile->name = $track;
    $musicFile->artist = $artist;
    $musicFile->album = $album;
    $musicFile->realease = $releaseYear;
    $musicFile->src = 'app/media/' . $fileName . '.mp3';
    $musicFile->thumbnail = 'app/media/' . $fileName . '.jpg';

    $data = file_get_contents("../app/data/library.json");
    $json = json_decode($data, true);
    array_push($json, $musicFile);

    $handle = fopen('../app/data/library.json', 'w');
    fwrite($handle, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_QUOT));
    fclose($handle);

    /*

        getMusic( ) {
            Rodar apenas em segundo plano, assim que o usuário clicar em "DOWNLOAD", exibir aviso que a música está baixando e que em breve aparecerá no player.

            purgeCache( )
        }
        purgeCache( ) {
            Função necessária sempre que fizer download de uma música nova, para dar refresh na listagem.
        }

        addMusicToData( ) {
            Instanciar objeto JSON na memória - e principalmente gravar no arquivo - apenas se o download for bem-sucedido.
        }
        removeMusicFromData( ) {
            Remover objeto do JSON.
        }
        addMusicToPlaylist( ) {
            Instanciar objeto JSON na memória - e principalmente gravar no arquivo - apenas se o download for bem-sucedido.
        }
        removeMusicFromPlaylist( ) {
            Remover objeto do JSON.
        }

    */
