<p align="center">
<img width="150" src="app/img/replay-logo-favicon.svg"></p>
<h1 align="center">RePlay</h1>
<p align="center">Web Music Player with GUI for youtube-dl command-line.<p>

><div align="center">⚠️
><div align="center">Attention: This project is under development.

- [DESCRIPTION](#description) 
- [REQUIREMENTS](#requirements)
- [HOW TO USE](#how-to-use)
- [DEV](#dev)
- [COPYRIGHT](#copyright)
- [SCREENSHOTS](#screenshots)

<hr>

# DESCRIPTION
Replay is a Web App created to manage your personal music library, integrated with the youtube-dl command-line app. It is released to the public domain, which means you can modify it, redistribute it or use it however you like.

Demo: <a href="https://demo.paulogobetti.com/replay">here</a>.

⚠️ Warning: The Downloader feature only works with audio media (Tema, Topic, 'official channels', etc.), which have the appropriate tags that will be extracted from the object. Attempting to download a link that does not have the tags will generate an incorrect JSON object and break the dynamic listing.

<hr>

# REQUIREMENTS
Some dependencies are required both to run the app and its download extension.

|   lib             |   ver
|---------------------------|-------------------------------
|apache|`2.4`|
|php|`7.2+`|
|python|`2.6, 2.7, or 3.2+`|
|youtube-dl|`current`|
|ffmpeg|`binary`|

<hr>

# HOW TO USE
Require: **git**, **docker** and **sudo**

```console
git clone https://github.com/paulogobetti/replay.git /home/$USER/.replay && cd /home/$USER/.replay && docker build -t replay . && docker run -d -p 8383:80 -v /home/$USER/.replay:/var/www/html replay && sudo chown www-data:www-data -R /home/$USER/.replay
```

<p>
&nbsp&nbsp&nbspNote: For the app to be able to use shell_exec() and exec() it is necessary to change the ownership of the directory to the same Apache user (www-data) - that's why sudo is necessary.<br>
&nbsp&nbsp&nbspYou could do the reverse and try changing the Apache user to $USER or putting it in the 'docker' group in Dockerfile, but all functionality is not guaranteed to hold.<br>
&nbsp&nbsp&nbsp⚠️ Warning: This software is under development and is not recommended for use on an insecure network. If you decide to use it, remember to change the php.ini for production.
</p>

<hr>

# DEV

Timeline:
- [x] Basic front-end
- [x] Music data JSON listing
- [x] Playlist JSON listing
- [x] Push metatags in music file
- [x] Add music from web
- [ ] Add music from client
- [x] Add new music in JSON data
- [x] Add new playlist in JSON data
- [x] Player wrapper
- [x] Controls: ~~Play~~, ~~Pause~~, Next, Back, Vol, ~~Progress Bar~~
- [x] Post-process the audio and thumbnail
- [x] Add cropped thumbnail in music audio metadata 
- [x] AJAX nav
- [ ] Export playlist
- [ ] Remove playlist
- [ ] Remove music
- [ ] Remove music from playlist
- [ ] Equalizer
- [ ] Theme Editor
- [ ] Last.fm integration
- [ ] Spectogram?
- [ ] Compressor?

<hr>

# COPYRIGHT

**Replay** is a public domain software and does not support copyrighted content in any way. <br>
The Downloader feature of this player was developed to be used exclusively with royalty free content, choose correctly what you are going to download and do not incorporate this app in any project that violates copyright!

<hr>

# SCREENSHOTS
<img src="https://paulogobetti.com/media/replay-screenshot.png">
