<?php

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

    $musicURL = $_POST['url'];

    const YOUTUBEDL = 'python3 ./includes/youtube-dl';
    const FFMPEG = './includes/ffmpeg-*/ffmpeg';
    const CACHE_DIR = './.cache';
    const MEDIA_DIR = '../app/media/';

    function getMeta() {
        global $musicURL;

        $command = YOUTUBEDL . ' --no-playlist --cache-dir ' . CACHE_DIR . ' --no-check-certificate --no-continue --get-filename -o "%(artist)s#%(track)s#%(album)s#%(release_year)s#%(duration)s" ' . $musicURL . ' 2>&1';

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

        $command = YOUTUBEDL . ' --no-playlist --cache-dir ' . CACHE_DIR . ' --no-check-certificate --no-continue -x --audio-format mp3 --audio-quality 320K --write-thumbnail --ffmpeg-location ' . FFMPEG . ' -o "' . MEDIA_DIR . 'temp.%(ext)s" ' . $musicURL . ' 2>&1';

        shell_exec($command);

        cropAndInsertCover();
    }

    function cropAndInsertCover() {
        global $musicURL;
        global $fileType;

        $getThumbnailURL = YOUTUBEDL . ' --no-playlist --cache-dir ' . CACHE_DIR . ' --no-check-certificate --no-continue --get-thumbnail ' . $musicURL;
        $explode = explode('.', shell_exec($getThumbnailURL));
        $getFileType = trim($explode[3]);
        $fileType = $getFileType;

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

    function checkSucess() {
        //
    }

    function purgeCache() {
        header("Cache-Control: no-cache, no-store, must-revalidate");

        echo '<script src="../app/data/library.json"></script>';

        header('location: /');
    }

    function main() {
        global $musicURL;

        if(!$musicURL) { header('location: /'); }

        $music = getMeta();

        getFiles();

        postProcessing($music);

        clearFiles();

        addMusicToData($music);

        purgeCache();
    }

    main();
