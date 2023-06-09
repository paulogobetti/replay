<?php

    require 'check-success.php';

/*
    --no-playlist               Ignorar playlists e baixar apenas o vídeo referenciado no link.
    --cache-dir DIR             Setar diretório de cache (youtube-dl).
    --no-check-certificate      Ignorar checagem de SSL.
    --no-continue               Parar processo caso alguma informação seja perdida.
    -x                          Extrair o áudio apenas.
    --audio-format mp3          Setar formato de saída mp3.
    --audio-quality 320K        Setar bitrate para 320Kbps.
    --add-metadata              Inserir metadata ao arquivo de áudio.
    --embed-thumbnail           Inserir thumbnail no arquivo de áudio.
    --write-thumbnail           Salvar thumbnail.
    --ffmpeg-location DIR       Caminho do ffmpeg.
    -o                          Setar arquivo e diretório de saída.
*/

    $musicURL = $_GET['url'];

    const YOUTUBE_DL = 'python3 ./includes/youtube-dl';
    const FFMPEG     = './includes/ffmpeg-*/ffmpeg';
    const CACHE_DIR  = './.cache';
    const MEDIA_DIR  = '../app/media/';

    function getMeta() {
        global $musicURL;

        $command = YOUTUBE_DL . ' --no-playlist --cache-dir ' . CACHE_DIR . ' --no-check-certificate --no-continue --get-filename -o "%(artist)s#%(track)s#%(album)s#%(release_year)s#%(duration)s" ' . $musicURL . ' 2>&1';

        $getMeta = explode('#', trim(shell_exec($command)));
        $artists = explode(',', $getMeta[0]);

        $music = new stdClass;
        $music->id = uniqid();
        $music->artist = $artists[0];
        $music->track = str_replace(array('originalmix', 'Original Mix', 'Original_Mix', 'original mix', 'original_mix', '(originalmix)', '(Original Mix)', '(Original_Mix)', '(original mix)', '(original_mix)'), '', $getMeta[1]);
        $music->album = $getMeta[2];
        $music->release = $getMeta[3];
        $music->duration = $getMeta[4];

        $fileNameString = $music->artist . '_' . $music->track . '_' . $music->release;
        $insertUnderscore = str_replace(' ', '_', $fileNameString);
        $fileName = str_replace(array(' ', "\t", "\n", '(', ')', '.', '/', 'originalmix', 'Original Mix', 'Original_Mix', 'original mix', 'original_mix'), '', $insertUnderscore);

        $music->src = 'app/media/' . $fileName . '.mp3';
        $music->thumbnail = 'app/media/' . $fileName . '.png';

        $music->file_name = $fileName;

        return $music;
    }

    function getFiles() {
        global $musicURL;

        $command = YOUTUBE_DL . ' --no-playlist --cache-dir ' . CACHE_DIR . ' --no-check-certificate --no-continue -x --audio-format mp3 --audio-quality 320K --ffmpeg-location ' . FFMPEG . ' -o "' . MEDIA_DIR . 'temp.%(ext)s" ' . $musicURL;

        shell_exec($command);

        cropAndInsertCover();
    }

    function cropAndInsertCover() {
        global $musicURL;
        global $fileType;
        global $thumbnailURL;

        $getThumbnailURL = YOUTUBE_DL . ' --list-thumbnails ' . $musicURL;
        $exec = exec($getThumbnailURL);
        $explode = explode('https://', $exec);
        $explode = explode('?', $explode[1]);
        $thumbnailURL = $explode[0];

        $explode = explode('.', $thumbnailURL);
        $fileType = $explode[3];

        $getThumbnail = 'curl -L '.$thumbnailURL.' --output "'.MEDIA_DIR.'/temp.'.$fileType.'"';

        shell_exec($getThumbnail);

        $crop   = FFMPEG . ' -i "' . MEDIA_DIR . 'temp.'.$fileType.'" -filter:v "crop=out_w=in_h" "' . MEDIA_DIR . 'cover.png"';
        $insert = FFMPEG . ' -i "' . MEDIA_DIR . 'temp.mp3" -i "'.MEDIA_DIR.'cover.png" -map 0:0 -map 1:0 -codec copy -id3v2_version 3 -metadata:s:v title="Album cover" -metadata:s:v comment="Cover (front)" "' . MEDIA_DIR . 'final.mp3"';

        shell_exec($crop);
        shell_exec($insert);
    }

    function postProcessing($music) {
        $command = FFMPEG . ' -i "' . MEDIA_DIR . 'final.mp3" -metadata title="'.$music->track.'" -metadata artist="'.$music->artist.'" -metadata album="'.$music->album.'" -metadata date="'.$music->release.'" -c copy "' . MEDIA_DIR . ''.$music->file_name.'.mp3"';

        shell_exec($command);

        renameThumbnail($music->file_name);
    }

    function renameThumbnail($fileName) {
        $command = 'mv "' . MEDIA_DIR . 'cover.png" "' . MEDIA_DIR . ''.$fileName.'.png"';

        shell_exec($command);
    }

    function clearFiles() {
        global $fileType;

        $command = 'rm "' . MEDIA_DIR . 'temp.mp3" "' . MEDIA_DIR . 'final.mp3" "' . MEDIA_DIR . 'temp.'.$fileType.'"';

        shell_exec($command);
    }

    function addMusicToData($music) {
        $data = file_get_contents("../app/data/library.json");
        $json = json_decode($data, true);
        array_push($json, $music);

        $handle = fopen('../app/data/library.json', 'w');
        fwrite($handle, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_QUOT));
        fclose($handle);
    }

    function purgeCache() {
        // Testar abordagem abaixo futuramente e fazer um benchmark pra saber qual melhor.
        // Levar em consideração a compatibilidade entre os navegadores e se o 'no-cache' do cabeçalho seta para não ter cache de forma persistente após a execução (ruim).
        // A abordagem abaixo altera o timestamp de modificação dos arquivos, fazendo o navegador e o servidor notarem a alteração e atualizar.
        // touch('/www/control/file1.js');

        header("Cache-Control: no-cache, no-store, must-revalidate");

        clearstatcache();

        echo '<script src="../app/data/library.json"></script>';
    }

    function main() {
        global $musicURL;

        if(strstr($musicURL,"youtube.com") != true) {
            $message = 'Not a YouTube link.';

            exit($message);
        }

        $music = getMeta();

        getFiles();

        postProcessing($music);

        clearFiles();

        addMusicToData($music);

        clearstatcache();

        // purgeCache();

        checkSuccess();
    }

    main();
