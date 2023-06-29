let mainPlaylist = []

const listLibrary = ( ) => {
    fetch('app/data/library.json')
    .then(res => res.json())
    .then(data => {
        let tbody = document.getElementById('tbody')
        tbody.innerText = ''
        data.forEach(i => {
            let musicLineItem = document.createElement('tr')
            musicLineItem.classList.add('music-card-line')

            let thumbnailCol = document.createElement('td')
            thumbnailCol.classList.add('music-thumbnail-col')
            let playButtonCol = document.createElement('td')
            playButtonCol.classList.add('button-col')
            let addToPlaylistCol = document.createElement('td')
            addToPlaylistCol.classList.add('button-col')
            let trackNameCol = document.createElement('td')
            let artistNameCol = document.createElement('td')
            let albumCol = document.createElement('td')
            let durationCol = document.createElement('td')
            let releaseCol = document.createElement('td')

            let coverUrl = i.thumbnail
            let cover = document.createElement('img')
            cover.src = coverUrl
            cover.classList.add('music-thumbnail')
            thumbnailCol.append(cover)
            musicLineItem.append(thumbnailCol)
            tbody.append(musicLineItem)

            let buttonLink = document.createElement('a')

            buttonLink.addEventListener('click', event => {
                playMusicFromList(i)
            })

            let playButton = document.createElement('img')
            playButton.src = 'app/img/play-list-button.svg'
            playButton.classList.add('generic-btn')
            buttonLink.append(playButton)
            playButtonCol.append(buttonLink)
            musicLineItem.append(playButtonCol)

            buttonLink = document.createElement('a')
            let addToPlaylistButton = document.createElement('button')
            addToPlaylistButton.innerHTML = i.id
            addToPlaylistButton.classList.add('modal-button')
            let trackID = i.id
            addToPlaylistButton.setAttribute('onclick', 'showModal("' + trackID + '")')

            buttonLink.append(addToPlaylistButton)
            addToPlaylistCol.append(buttonLink)
            musicLineItem.append(addToPlaylistCol)

            let musicTitle = document.createElement('h3')
            musicTitle.innerHTML = i.track
            trackNameCol.append(musicTitle)
            musicLineItem.append(trackNameCol)

            let artist = document.createElement('h3')
            artist.innerHTML = i.artist
            artistNameCol.append(artist)
            musicLineItem.append(artistNameCol)

            let album = document.createElement('h3')
            album.innerHTML = i.album
            albumCol.append(album)
            musicLineItem.append(albumCol)

            let duration = document.createElement('h3')
            let durationInMinutes = i.duration / 60
            let formatedDuration = durationInMinutes.toString().substring(0, 4)
            // let formatedDuration = new Intl.DateTimeFormat('minute', { timeStyle: 'short' }).format(durationInMinutes)
            // console.log(new Intl.DateTimeFormat('default', { hour: 'numeric', minute: 'numeric', second: 'numeric' }).format(durationInMinutes))
            duration.innerHTML = formatedDuration
            durationCol.append(duration)
            musicLineItem.append(durationCol)

            let release = document.createElement('h3')
            release.innerHTML = i.release
            releaseCol.append(release)
            musicLineItem.append(releaseCol)
        })
    })
}
listLibrary( )

const listPlaylists = ( ) => {
    fetch('app/data/playlist.json')
    .then(res => res.json())
    .then(data => {
        data.forEach(i => {
            let playlists = document.getElementsByClassName('playlists')[0]

            let playlistLink = document.createElement('a')
            let playlistTitle = document.createElement('h3')

            playlistLink.href = '#'
            playlistTitle.innerHTML = i.playlist_name

            playlistLink.append(playlistTitle)
            playlists.append(playlistLink)
        })
    })
}
listPlaylists( )

const listPlaylistsModal = (id) => {
    let playlistsModal = document.getElementsByClassName('playlists')[1]
    playlistsModal.innerHTML = ''
    fetch('app/data/playlist.json')
    .then(res => res.json())
    .then(data => {
        data.forEach(playlist => {
            let playlistLinkModal = document.createElement('a')
            let playlistLinkModalTitle = document.createElement('h3')

            playlistLinkModal.href = '../src/add-to-playlist.php/?playlist=' + playlist.playlist_id + '&music=' + id
            playlistLinkModalTitle.innerHTML = playlist.playlist_name

            playlistLinkModal.append(playlistLinkModalTitle)

            playlistsModal.append(playlistLinkModal)
        })
    })
}

// Player
let audioPlayer = document.getElementById('audio-player')
let playButton = document.getElementById('play-button')
let pauseButton = document.getElementById('pause-button')
let range = document.getElementById('range')
pauseButton.style.display = 'none'

document.addEventListener('DOMContentLoaded', ( ) => {
    document.getElementById('play-button').addEventListener('click', playMusic)
})

document.addEventListener('DOMContentLoaded', ( ) => {
    document.getElementById('pause-button').addEventListener('click', pauseMusic)
})

const playMusic = ( ) => {
    playButton.style.display = 'none'
    pauseButton.style.display = 'inline'

    audioPlayer.play()
}

const playMusicFromList = (music) => {
    let titleDisplay = document.getElementById('title-display')
    let imgUrl = music.thumbnail

    // let musicThumbnail = document.getElementById('player-thumbnail')
    // musicThumbnail.src = music.thumbnail

    switchImageBg(imgUrl)

    titleDisplay.innerHTML = '<h4>' + music.artist + ' - ' + music.track + '<h4>'

    playButton.style.display = 'none'
    pauseButton.style.display = 'inline'

    audioPlayer.src = music.src
    audioPlayer.play()
}

const switchImageBg = (imgUrl) => {
    let imageClass = 'url("' + imgUrl + '")'

    let contentDisplay = document.getElementById('content-display')

    let imageBg = document.getElementById('background-image')

    imageBg.style.backgroundImage = imageClass
    contentDisplay.style.backgroundImage = "linear-gradient(to right bottom, #1a1b20, #202128bb)"
}

const pauseMusic = ( ) => {
    playButton.style.display = 'inline'
    pauseButton.style.display = 'none'

    audioPlayer.pause()
}

const velControl = (vel) => {
    // defaultPlaybackRate
    let audio = document.querySelector('audio')
    audio.defaultPlaybackRate = vel

    audio.load()
    audio.play()
}

// Range Progress Update
audioPlayer.onloadedmetadata = function() {
    range.max = audioPlayer.duration
    range.value = audioPlayer.currentTime
}

if(audioPlayer) {
    setInterval(( ) => {
        range.value = audioPlayer.currentTime
    }, 888)
}

range.onchange = ( ) => {
    audioPlayer.play()
    audioPlayer.currentTime = range.value
}

// Modals
let modal = document.getElementsByClassName('modal');
let button = document.getElementsByClassName("modal-button"); // MyBtn
let span = document.getElementsByClassName("close");

button[0].onclick = ( ) => {
    modal[0].style.display = "block";
}

span[0].onclick = ( ) => {
    modal[0].style.display = "none";
}

span[1].onclick = ( ) => {
    modal[1].style.display = "none";
}

window.onclick = (event) => {
    console.log('Click')
    if(event.target == modal[0] || event.target == modal[1]) {
        modal[0].style.display = "none";
        modal[1].style.display = "none";
    }
}

const showModal = (id) => {
    console.log(id)
    listPlaylistsModal(id)

    modal[1].style.display = "block";
}
