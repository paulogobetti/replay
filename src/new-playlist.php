<?php

    require 'check-success.php';

    $playlistName = $_GET['new'];

    $newPlaylist = new stdClass;
    $newPlaylist->playlist_id = uniqid();
    $newPlaylist->playlist_name = $playlistName;
    $newPlaylist->tracks = [];

    $data = file_get_contents("../app/data/playlist.json");
    $json = json_decode($data, true);
    array_push($json, $newPlaylist);

    $handle = fopen('../app/data/playlist.json', 'w');
    fwrite($handle, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_QUOT));
    fclose($handle);

    checkSuccess();
