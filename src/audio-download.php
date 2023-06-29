<?php

/*
    --no-playlist               Ignora playlists e baixa apenas o vídeo referenciado no link.
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

    $musicURL = $_POST['url'];

    $ytDownloaderAlias = 'python3 ./includes/youtube-dl';
    $ffmpegAlias = './includes/ffmpeg-*/ffmpeg';
    $cacheDir = './.cache';

    function getMeta() {
        global $musicURL;
        global $ytDownloaderAlias;
        global $cacheDir;

        $command = $ytDownloaderAlias . ' --no-playlist --cache-dir ' . $cacheDir . ' --no-check-certificate --no-continue --get-filename -o "%(artist)s#%(track)s#%(album)s#%(release_year)s#%(duration)s" ' . $musicURL . ' 2>&1';

        $getMeta = explode('#', trim(shell_exec($command)));
        $artists = explode(',', $getMeta[0]);

        $music = new stdClass;
        $music->id = uniqid();
        $music->artist = $artists[0];
        $music->track = $getMeta[1];
        $music->album = $getMeta[2];
        $music->release = $getMeta[3];
        $music->duration = $getMeta[4];

        $fileNameString = $music->artist . '_' . $music->track . '_' . $music->release;
        $insertUnderscore = str_replace(' ', '_', $fileNameString);
        $fileName = str_replace(array(' ', "\t", "\n", '(', ')', '.', '/'), '', $insertUnderscore);

        $music->src = 'app/media/' . $fileName . '.mp3';
        $music->thumbnail = 'app/media/' . $fileName . '.png';

        $music->file_name = $fileName;

        return $music;
    }

    function getFiles() {
        global $musicURL;
        global $ytDownloaderAlias;
        global $cacheDir;

        $command = $ytDownloaderAlias . ' --no-playlist --cache-dir ' . $cacheDir . ' --no-check-certificate --no-continue -x --audio-format mp3 --audio-quality 320K --write-thumbnail --ffmpeg-location ./includes/ffmpeg-*/ffmpeg -o "../app/media/temp.%(ext)s" ' . $musicURL . ' 2>&1';

        shell_exec($command);

        cropAndInsertCover();
    }

    function cropAndInsertCover() {
        global $musicURL;
        global $ffmpegAlias;
        global $ytDownloaderAlias;
        global $cacheDir;
        global $fileType;

        $getThumbnailURL = $ytDownloaderAlias . ' --no-playlist --cache-dir ' . $cacheDir . ' --no-check-certificate --no-continue --get-thumbnail ' . $musicURL;
        $explode = explode('.', shell_exec($getThumbnailURL));
        $getFileType = trim($explode[3]);
        $fileType = $getFileType;

        $crop   = $ffmpegAlias . ' -i "../app/media/temp.'.$fileType.'" -filter:v "crop=out_w=in_h" "../app/media/cover.png"';
        $insert = $ffmpegAlias . ' -i "../app/media/temp.mp3" -i "../app/media/cover.png" -map 0:0 -map 1:0 -codec copy -id3v2_version 3 -metadata:s:v title="Album cover" -metadata:s:v comment="Cover (front)" "../app/media/final.mp3"';

        shell_exec($crop);
        shell_exec($insert);
    }

    function postProcessing($music) {
        global $ffmpegAlias;

        $command = $ffmpegAlias . ' -i "../app/media/final.mp3" -metadata title="'.$music->track.'" -metadata artist="'.$music->artist.'" -metadata album="'.$music->album.'" -metadata date="'.$music->release.'" -c copy "../app/media/'.$music->file_name.'.mp3"';

        shell_exec($command);

        renameThumbnail($music->file_name);
    }

    function renameThumbnail($fileName) {
        $command = 'mv "../app/media/cover.png" "../app/media/'.$fileName.'.png"';

        shell_exec($command);
    }

    function clearFiles() {
        global $fileType;

        $command = 'rm "../app/media/temp.mp3" "../app/media/final.mp3" "../app/media//temp.'.$fileType.'"';

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
        //
    }

    function main() {
        global $musicURL;

        if(!$musicURL) { header('location: /'); }

        $music = getMeta();

        getFiles();

        postProcessing($music);

        clearFiles();

        addMusicToData($music);
    }

    main();
