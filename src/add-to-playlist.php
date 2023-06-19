<?php

    $data = file_get_contents("../app/data/playlist.json");
    $json = json_decode($data);

    $playlistID = urldecode($_GET['playlist']);
    $music = urldecode($_GET['music']);

    foreach($json as $playlist) {
        if($playlist->playlist_id ==  $playlistID) {
            array_push($playlist->tracks, $music);
        }
    }

    $handle = fopen('../app/data/playlist.json', 'w');
    fwrite($handle, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_QUOT));
    fclose($handle);
