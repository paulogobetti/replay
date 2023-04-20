<?php?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePlay</title>
    <style>
        * {margin: 0; padding: 0; box-sizing: border-box;}
        .fit-to-screen {width: 100%; height: 100vh; display: flex; padding-bottom: 10vh;}
        #global-side-bar {background: #fd0; width: 23%; padding: 2%; overflow-y: auto; overflow-x: hidden;}
        #library {background: red; width: 77%;}
        .logo {max-width: 50px; width: 100%;}
        .nav-menu {background: green; padding: 10px;}
        .nav-menu a {text-decoration: none;}
        .nav-menu-item {padding: 1em; transition: .2s; border-radius: 2em; color: black;}
        .nav-menu-item:hover {background: #fd0;}
        .nav-menu-item-selected {color: #fff;}
    </style>
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
                <p>PLAYLISTS</p>
                <a href="index.php"><p class="nav-menu-item">Playlist 1</p></a> <br>
                <a href="index.php"><p class="nav-menu-item">Playlist 2</p></a> <br>
                <a href="index.php"><p class="nav-menu-item">Playlist 3</p></a> <br>
                <a href="index.php"><p class="nav-menu-item">Playlist 4</p></a> <br>
            </div>
        </div>
        <div id="library">

        </div>
    </div>
</div>
</body>
</html>
