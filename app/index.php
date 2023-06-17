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
    <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>

</head>

<body>

<div>
    <audio preload="none" src="" id="audio-player" type="audio/mpeg" controls></audio>
</div>

<div id="body">

    <div class="container">   <!-- MAIN LAYOUT -->
    <div id="background-image"></div>   <!-- DYNAMIC IMAGE BG -->

        <div id="global-side-bar">   <!-- SIDE BAR -->
            <img src="app/img/replay-logo-white.svg" alt="" class="logo">
            <nav class="nav-menu">   <!-- NAV MENU -->
                <a href="/" class="nav-menu-item nav-menu-item-selected"><img src="app/img/nav-menu-home-active.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspHome&nbsp&nbsp</a> <br>
                <a href="app/playlists.php" class="nav-menu-item"><img src="app/img/library-button.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspPlaylists&nbsp&nbsp</a> <br>
                <a href="app/downloader.php" class="nav-menu-item"><img src="app/img/nav-menu-downloader.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspDownloader&nbsp&nbsp</a> <br>
                <a href="app/tag-editor.php" class="nav-menu-item"><img src="app/img/nav-music-editor.svg" width="30" height="30" alt="" class="nav-menu-icon">&nbsp&nbspMusic Editor&nbsp&nbsp</a>
            </nav>
            <div class="playlists-container">   <!-- PLAYLIST LINKS -->
                <h5>P L A Y L I S T S</h5>
                <div id="playlists" >
                </div>
                <a href="#" id="new-playlist-button">New Playlist</a>

                <!-- The Modal -->
                <div id="new-playlist-modal" class="modal">
                    <div class="modal-content">
                        <form action="../src/new-playlist.php" method="POST">
                            <input type="text" name="playlist-name" value="Playlist Name">
                            <span class="close">&times;</span>
                            <a href=""><button>Teste</button></a>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <a href=""><img src="app/img/config-button.svg" width="30" height="30" alt="" class="config-button"></a>
            </div>
        </div>

        <div id="content-display">   <!-- CONTENT -->
            <table class="table">
                <tbody id="tbody">
                </tbody>
            </table>
        </div>

    </div>

    <div class="player">   <!-- PLAYER -->
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

</div>

<script src="app/scripts/main.js"></script>
<script>
  let modal = document.getElementById("new-playlist-modal");
  let btn = document.getElementById("new-playlist-button");
  let span = document.getElementsByClassName("close")[0];

  btn.onclick = ( ) => {
    modal.style.display = "block";
  }

  span.onclick = ( ) => {
    modal.style.display = "none";
  }

  window.onclick = (e) => {
    if (e.target == modal) {
      modal.style.display = "none";
    }
  }
</script>

</body>
</html>
