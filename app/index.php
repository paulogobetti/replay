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
<!-- HIDDEN PLAYER -->
<div>
    <audio preload="none" src="" id="audio-player" type="audio/mpeg" controls></audio>
</div>

<div id="body">
    <!-- LAYOUT -->
    <div class="container">
    <!-- IMAGE BG -->
    <div id="background-image"></div>

        <!-- SIDE BAR -->
        <div id="global-side-bar">
            <img src="app/img/replay-logo-white.svg" alt="" class="logo">

            <!-- NAV MENU -->
            <nav class="nav-menu">
                <a href="/" class="nav-menu-item nav-menu-item-selected"><img src="app/img/nav-menu-home-active.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspHome&nbsp&nbsp</a> <br>
                <a href="app/playlists.php" class="nav-menu-item"><img src="app/img/library-button.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspPlaylists&nbsp&nbsp</a> <br>
                <a href="app/downloader.php" class="nav-menu-item"><img src="app/img/nav-menu-downloader.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspDownloader&nbsp&nbsp</a> <br>
                <a href="app/tag-editor.php" class="nav-menu-item"><img src="app/img/nav-music-editor.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspMusic Editor&nbsp&nbsp</a>
            </nav>

            <!-- PLAYLIST LINKS -->
            <div class="playlists-container">
                <h5>P L A Y L I S T S</h5>
                <div class="playlists">
                </div>
                <a href="#" id="new-playlist-button" class="modal-button">New Playlist</a>
            </div>

            <!-- CONFIG BUTTON -->
            <div>
                <a href=""><img src="app/img/config-button.svg" width="30" height="30" alt="" class="config-button"></a>
            </div>
        </div>

        <!-- CONTENT -->
        <div id="content-display">
            <table class="table">
                <tbody id="tbody">
                </tbody>
            </table>
        </div>
    </div>

    <!-- WRAPPER PLAYER -->
    <div class="player">
        <div class="player-controls">
            <div class="title-display" id="title-display">&nbsp</div>
            <!-- <img id="player-thumbnail" src="" alt=""> -->
            <div class="player-buttons">
                <a href="#" id="back-button"><img src="app/img/back-button.svg" alt="" class="generic-btn"></a>
                <a href="#" id="play-button"><img src="app/img/play-button.svg" alt="" class="play-button"></a>
                <a href="#" id="pause-button"><img src="app/img/pause-button.svg" alt="" class="play-button"></a>
                <a href="#" id="foward-button"><img src="app/img/foward-button.svg" alt="" class="generic-btn"></a>
            </div>
            <input type="range" name="range" value="0" id="range" class="" onclick="">
        </div>
    </div>

    <!-- MODALS -->

    <!-- NEW PLAYLIST MODAL -->
    <div id="new-playlist-modal" class="modal">
        <!-- MODAL CONTENT -->
        <div class="modal-content">
            <span class="close">×</span>
            <form action="../src/new-playlist.php" method="POST">
                <input type="text" name="playlist-name" value="Playlist Name">
                <a href="" id="save-playlist-button"><button>Save Playlist</button></a>
            </form>
        </div>
    </div>

    <!-- ADD TO PLAYLIST MODAL -->
    <div id="add-to-playlist-modal" class="modal">
        <!-- MODAL CONTENT -->
        <div class="modal-content">
            <span class="close">×</span>
            <div class="playlists">
            </div>
        </div>
    </div>

</div>
    <script src="app/scripts/main.js"></script>
</body>
</html>
