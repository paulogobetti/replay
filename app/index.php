<?php?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RePlay</title>
    <!-- FAVICON -->
    <link rel="icon" type="image/x-icon" href="app/img/replay-logo-favicon.svg">
    <!-- LAYOUT STYLE -->
    <link rel="stylesheet" href="app/style/layout.css">

</head>

<body>
<div>
    <audio src="" id="audio-player" type="audio/mpeg" controls></audio>
</div>
<div id="body">

    <div class="container">   <!-- MAIN LAYOUT -->
        <div id="background-image"></div>   <!-- DYNAMIC GLASSMORPHISM CONTENT BACKGROUND -->

        <div id="global-side-bar">   <!-- SIDE BAR -->
            <img src="app/img/replay-logo-white.svg" alt="" class="logo">
            <nav class="nav-menu">   <!-- NAV MENU -->
                <a href="/replay" class="nav-menu-item nav-menu-item-selected"><img src="app/img/nav-menu-icon-01.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspHome&nbsp&nbsp</a> <br>
                <a href="app/playlists.php" class="nav-menu-item"><img src="app/img/nav-menu-icon-01.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspPlaylists&nbsp&nbsp</a> <br>
                <a href="app/downloader.php" class="nav-menu-item"><img src="app/img/nav-menu-icon-01.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspDownloader&nbsp&nbsp</a> <br>
                <a href="app/tag-editor.php" class="nav-menu-item"><img src="app/img/nav-menu-icon-01.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspMusic Editor&nbsp&nbsp</a>
            </nav>
            <div class="playlists-container">
                <h5>P L A Y L I S T S</h5>
                <div id="playlists" >
                </div>
            </div>
        </div>

        <div id="content-display">    <!-- CONTENT -->
            <table class="table">
                <tbody id="tbody">
                </tbody>
              </table>
        </div>
    </div>

    <div class="player">   <!-- PLAYER -->
        <div class="player-controls">
            <div class="title-display" id="title-display">&nbsp</div>
            <div class="player-buttons">
                <a href="#" id="back-button"><img src="app/img/back-button.svg" alt="" class="generic-btn"></a>
                <a href="#" id="play-button"><img src="app/img/play-button.svg" alt="" class="play-button"></a>
                <a href="#" id="pause-button"><img src="app/img/pause-button.svg" alt="" class="play-button"></a>
                <a href="#" id="foward-button"><img src="app/img/foward-button.svg" alt="" class="generic-btn"></a>
            </div>
            <div class="progress-bar">
                <div class="progress-update" style="width: 93%;"></div>
            </div>
        </div>
    </div>

</div>

<script src="app/scripts/main.js"></script>

</body>
</html>