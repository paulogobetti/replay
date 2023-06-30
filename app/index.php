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
    <link rel="stylesheet" href="app/style.css">
    <!-- AJAX -->
    <script src="app/scripts/ajax.js"></script>
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
                <a href="#" class="nav-menu-item" onclick="httpRequest('app/components/library.php')">
                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 960 960" width="30" height="30" >
                    <style>
                        .s0 { fill: #ffffff }
                    </style>
                    <path id="Layer" fill-rule="evenodd" class="s0" d="m200 800v-420l280-211.5 280 211.5v420h-223.1v-240h-113.8v240zm30.7-30.8h161.6v-240h175.4v240h161.5v-373.8l-249.2-188.9-249.3 188.6z"/>
                </svg>
                    &nbsp&nbspHome&nbsp&nbsp</a> <br>

                <a href="#" class="nav-menu-item" onclick="httpRequest('app/components/playlists.php')">
                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 960 960"  width="30" height="30">
                    <style>
                        .s0 { fill: #ffffff }
                    </style>
                    <path id="Layer" class="s0" d="m640.2 780q-41.5 0-70.7-28.5-29.3-28.5-29.3-69.2 0-40.7 28.6-69.2 28.6-28.5 69.5-28.5 17.9 0 35.2 6.1 17.2 6.1 34.5 19.2v-349.9h152v57.2h-121.2v365.7q0 40.5-28.6 68.8-28.5 28.3-70 28.3zm-500.2-164.6v-30.8h273.7v30.8zm0-162.7v-30.8h436.8v30.8zm0-161.9v-30.8h436.9v30.8z"/>
                </svg>
                    &nbsp&nbspPlaylists&nbsp&nbsp</a> <br>

                <a href="#" class="nav-menu-item" onclick="httpRequest('app/components/downloader.php')">
                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 960 960" width="30" height="30">
                    <style>
                        .s0 { fill: #ffffff }
                    </style>
                    <path id="Layer" class="s0" d="m255.4 760q-23.1 0-39.2-16.2-16.2-16.1-16.2-39.2v-106.1h30.8v106.1q0 9.2 7.7 16.9 7.7 7.7 16.9 7.7h449.2q9.2 0 16.9-7.7 7.7-7.7 7.7-16.9v-106.1h30.8v106.1q0 23.1-16.2 39.2-16.1 16.2-39.2 16.2zm224.6-147.6l-138.4-138.4 22.3-21.5 100.7 100v-366.3h30.8v366.3l100.8-100 22.2 21.5z"/>
                </svg>
                    &nbsp&nbspDownloader&nbsp&nbsp</a> <br>

                <a href="#" class="nav-menu-item" onclick="httpRequest('app/components/tag-editor.php')">
                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 960 960" width="30" height="30">
                    <style>
                        .s0 { fill: #ffffff }
                    </style>
                    <path id="Layer" fill-rule="evenodd" class="s0" d="m255.4 840q-23.1 0-39.2-16.2-16.2-16.1-16.2-39.2v-609.2q0-23.1 16.2-39.2 16.1-16.2 39.2-16.2h324.6l180 180v142.2h-30.8v-122.2h-169.2v-169.2h-304.6q-9.2 0-16.9 7.7-7.7 7.7-7.7 16.9v609.2q0 9.2 7.7 16.9 7.7 7.7 16.9 7.7h213.8v30.8zm310.8-74.1v46.4h46.4l157.7-158.5-46.2-45.8zm57 72.5h-83.1v-82.4l213.9-213.9q8.2-8.2 19.4-8.2 11.1 0 19.5 8.2l44.3 44.3q8.2 8.3 8.2 19.5 0 11.1-8.2 19.4l-48 47.1zm-392.4-29.2v-658.5z"/>
                </svg>
                    &nbsp&nbspMusic Editor&nbsp&nbsp</a>
            </nav>

            <!-- PLAYLISTS CARD -->
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
        <div id="content">
            <!-- DYNAMIC ASYNC CONTENT HERE -->
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
            <input type="text" name="playlist-name" value="Playlist Name" id="playlist-name">
            <a href="#" onclick="newPlaylistHook(document.getElementById('playlist-name').value)">NOVA PLAYLIST</a>
            <!-- <form action="../src/new-playlist.php" method="POST">
                <input type="text" name="playlist-name" value="Playlist Name">
                <a href="" id="save-playlist-button"><button>Save Playlist</button></a>
            </form> -->
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

    <script src="app/scripts/main.js"></script>
    <script src="app/scripts/hooks.js"></script>

</div>
</body>
</html>
