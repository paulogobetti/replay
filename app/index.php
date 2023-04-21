<?php?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePlay</title>
    <style>
        * {margin: 0; padding: 0; box-sizing: border-box; transition: 1s;}
        .fit-to-screen {width: 100%; height: 90vh; display: flex; }
        #global-side-bar {background: #fd0; width: 20%; padding: 2%; overflow-y: auto; overflow-x: hidden;}
        #library {background: red; width: 80%; padding: 50px;}
        .logo {max-width: 50px; width: 100%;}
        .nav-menu {background: green; padding: 10px;}
        .nav-menu a {text-decoration: none;}
        .nav-menu-item {padding: 1em; transition: .2s; border-radius: 2em; color: black;}
        .nav-menu-item:hover {background: #fd0;}
        .nav-menu-item-selected {color: #fff;}
        #music-card {background: #cc8; padding: 1%; width: 100%; border-radius: 2px; display: flex; gap: 5%; align-items: center; font-size: 12px;}
        .music-thumbnail {width: 88px;}

        .player {background: salmon; width: 100%; height: 10vh; position: absolute; display: flex; text-align: center; align-items: center;}
        .player-controls {background: blue; width: 100%;}
        .title-display {background: #fff; width: 30%; display: inline-block;}
        .title-display h4 {font-size: 15px; padding: 2px;}

        .player-buttons {background: orange;}
        .generic-btn {width: 40px;}

        .progress-bar {width: 100%; max-width: 920px; height: 9px; background: #000; border-radius: 8px; position: relative; display: inline-block;}
        .progress-update {position: absolute; left: 0; top: 0; width: 0; height: 9px; border-radius: 8px; color: #fff; background: #fff;}

        @media screen and (max-width: 920px) {
            #library {background: #000;}
        }
    </style>
    <script src="media.js"></script>
</head>
<body>
<div id="body">
    <div class="fit-to-screen">
        <div id="global-side-bar">
            <img src="img/replay-logo.svg" alt="" class="logo">
            <div class="nav-menu">
                <a href="index.php"><p class="nav-menu-item nav-menu-item-selected">Home</p></a> <br>
                <a href="playlists.html"><p class="nav-menu-item">Playlists</p></a> <br>
                <a href="youtube-dl.html"><p class="nav-menu-item">Downloader</p></a> <br>
                <a href="tag-editor.html"><p class="nav-menu-item">Music Editor</p></a>
            </div>
            <div class="nav-menu">
                <h4 style="padding: 1em;">PLAYLISTS</h4>
                <a href="index.php"><p class="nav-menu-item">Playlist 1</p></a> <br>
                <a href="index.php"><p class="nav-menu-item">Playlist 2</p></a> <br>
                <a href="index.php"><p class="nav-menu-item">Playlist 3</p></a> <br>
                <a href="index.php"><p class="nav-menu-item">Playlist 4</p></a> <br>
            </div>
        </div>
        <div id="library">
            <div id="music-card">
            </div>
        </div>
    </div>

    <div class="player">
        <div class="player-controls">
            <div class="title-display"><h4>Artista - Nome da Música</h4></div>
            <div class="player-buttons">
                <a href="#"><img src="img/button.svg" alt="" class="generic-btn"></a>
                <a href="#"><img src="img/button.svg" alt="" class="generic-btn"></a>
                <a href="#"><img src="img/button.svg" alt="" class="generic-btn"></a>
            </div>
            <div class="progress-bar">
                <div class="progress-update" style="width: 93%;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    const listLibrary = ( ) => {
        let coverUrl = data[0].thumbnail
        let playButton = document.createElement('img')
        playButton.src = 'img/button.svg'
        playButton.classList.add('generic-btn')
        let addToPlaylistButton = document.createElement('img')
        addToPlaylistButton.src = 'img/button.svg'
        addToPlaylistButton.classList.add('generic-btn')
        let musicTitle = document.createElement('h3')
        musicTitle.innerHTML = data[0].name
        let artist = document.createElement('h3')
        artist.innerHTML = data[0].artist
        let album = document.createElement('h3')
        album.innerHTML = data[0].album
        let duration = document.createElement('h3')
        duration.innerHTML = '02:05'
        let release = document.createElement('h3')
        release.innerHTML = data[0].realease

        let musicItem = document.getElementById('music-card')
        let cover = document.createElement('img')
        cover.src = coverUrl
        cover.classList.add('music-thumbnail')

        musicItem.append(cover)
        musicItem.append(playButton)
        musicItem.append(addToPlaylistButton)
        musicItem.append(musicTitle)
        musicItem.append(artist)
        musicItem.append(album)
        musicItem.append(duration)
        musicItem.append(release)
    }
    listLibrary( )
</script>
</body>
</html>
