<?php

    $playlistID = urldecode($_GET['playlist']);
    $musicID = urldecode($_GET['music']);

    echo 'Playlist ID: ' . $playlistID . ' e Music ID: ' . $musicID . '<br> ';
