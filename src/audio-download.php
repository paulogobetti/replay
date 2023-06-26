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

        return $getMeta;
    }

    function getFiles() {
        global $musicURL;
        global $ytDownloaderAlias;
        global $cacheDir;

        $command = $ytDownloaderAlias . ' --no-playlist --cache-dir ' . $cacheDir . ' --no-check-certificate --no-continue -x --audio-format mp3 --audio-quality 320K --write-thumbnail --ffmpeg-location ./includes/ffmpeg-*/ffmpeg -o "../app/media/temp.%(ext)s" ' . $musicURL . ' 2>&1';

        shell_exec($command);
    }

    // function getThumbnail() {
    //     global $musicURL;
    //     global $ytDownloaderAlias;
    //     global $cacheDir;

    //     $command = $ytDownloaderAlias . ' --no-playlist --cache-dir ' . $cacheDir . ' --no-check-certificate --no-continue --write-thumbnail -o "./temp.%(ext)s" ' . $musicURL . ' 2>&1';

    //     return shell_exec($command);
    // }

    // function insertThumbnail() {
    //     global $ffmpegAlias;

    //     print_r($musicInfo);
    //     // $teste = $musicInfo->track;
    //     // $command = $ffmpegAlias . ' -i "../app/media/temp.webp" -filter:v "crop=out_w=in_h" "' . $teste . '.jpg"';

    //     // shell_exec($command);

    //     // echo $command;
    // }

    function addMusicToData() {
        //
    }

    function clearFilesAndCache() {
        //
    }

    function checkSucess(){
        //
    }

    function cropAndInsertCover() {
        global $ffmpegAlias;

        $crop   = $ffmpegAlias . ' -i "../app/media/temp.webp" -filter:v "crop=out_w=in_h" "../app/media/cover.jpg"';
        $insert = $ffmpegAlias . ' -i "../app/media/temp.mp3" -i "../app/media/cover.jpg" -map 0:0 -map 1:0 -codec copy -id3v2_version 3 -metadata:s:v title="Album cover" -metadata:s:v comment="Cover (front)" "../app/media/final.mp3"';

        //$insertCoverCommand = 'ffmpeg -i temp.mp3 -i "Still Corners, Tessa Murray, Greg Hughes - Till We Meet Again - The Last Exit - 2021.jpg" -map 0:0 -map 1:0 -codec copy -id3v2_version 3 -metadata:s:v title="Album cover" -metadata:s:v comment="Cover (front)" "Still Corners, Tessa Murray, Greg Hughes - Till We Meet Again - The Last Exit - 2021.mp3"';

        $teste = shell_exec($crop);
        $teste2 = shell_exec($insert);

        var_dump($teste);
        var_dump($teste2);
    }

    function getMusic() {
        global $musicURL;

        if(!$musicURL) { header('location: /'); }

        $musicInfo = getMeta();
        getFiles();
        cropAndInsertCover();

        print_r($musicInfo);
    }

    cropAndInsertCover();

































    // $thumbnail = getThumbnail();


    // echo "<br>";
    // print_r($thumbnail);



    // $getFileCommand = 'python3 ./includes/youtube-dl --no-playlist --cache-dir .cache --no-check-certificate --no-continue -x --audio-format mp3 --audio-quality 320K --add-metadata --embed-thumbnail --write-thumbnail --ffmpeg-location ./includes/ffmpeg-*/ffmpeg -o "../app/media/%(artist)s - %(track)s - %(album)s - %(release_year)s.%(ext)s" ' . $url . ' 2>&1';
    // echo "<pre>$getFileCommand</pre>";
    // $getFile = shell_exec($getFileCommand);
    // echo "<pre>$getFile</pre>";

    // $getMusicInfoCommand = 'python3 ./includes/youtube-dl --no-playlist --cache-dir .cache --no-check-certificate --get-filename ' . $url . ' -o "%(track)s#%(artist)s#%(album)s#%(release_year)s#%(duration)s" 2>&1';
    // $getFileNameCommand  = 'python3 ./includes/youtube-dl --no-playlist --cache-dir .cache --no-check-certificate --get-filename ' . $url . ' -o "%(artist)s - %(track)s - %(album)s - %(release_year)s" 2>&1';

    // $getMusicInfo = shell_exec($getMusicInfoCommand);
    // $getFileName = shell_exec($getFileNameCommand);

    // $fileName = trim($getFileName);
    // $musicInfo = explode('#', $getMusicInfo);

    // $track = ucwords(strtolower($musicInfo[0]));
    // $artist = ucwords(strtolower($musicInfo[1]));
    // $mainArtist = explode(',', $artist);

    // $album = ucwords(strtolower($musicInfo[2]));
    // $releaseYear = $musicInfo[3];
    // $duration = $musicInfo[4];

    // $musicFile = new stdClass;
    // $musicFile->track_id = uniqid();
    // $musicFile->name = $track;
    // $musicFile->artist = $mainArtist[0];
    // $musicFile->album = $album;
    // $musicFile->realease = $releaseYear;
    // $musicFile->src = 'app/media/' . $fileName . '.mp3';
    // $musicFile->thumbnail = 'app/media/' . $fileName . '.jpg';
    // $musicFile->duration = $duration;

    // $data = file_get_contents("../app/data/library.json");
    // $json = json_decode($data, true);
    // array_push($json, $musicFile);

    // $handle = fopen('../app/data/library.json', 'w');
    // fwrite($handle, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_QUOT));
    // fclose($handle);

















            // print_r($musicInfo);

        // echo $callback;


        // return $callback('Teste');





        // var_dump($getMeta);
        // print_r($getMeta);
        // echo "Hello";
        // $getMeta = explode('#', trim(shell_exec($command)));
        // $novo = explode(',', $getMeta);
        // $musicInfo[1] = explode(',', $getMeta);
        // $getMeta = trim(shell_exec($command));
        // $musicInfo = explode('#', $getMeta);
        // $musicInfo[1] = explode(',', $getMeta);






                // if(!$musicURL && !$thumbnail) {
        //     header('location: /');
        // } else {
        //     print_r($thumbnail);
        // }