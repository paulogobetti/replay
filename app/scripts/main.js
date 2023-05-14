const listLibrary = ( ) => {
    fetch('app/data/library.json')
    .then(response => response.json())
    .then(data => {
        let tbody = document.getElementById('tbody')
        tbody.innerText = ''
        data.forEach(i => {
            // Retornar paginado... while?
            // let library = document.getElementById('content-display')

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

            let playButton = document.createElement('img')
            playButton.src = 'app/img/play-list-button.svg'
            playButton.classList.add('generic-btn')
            playButtonCol.append(playButton)
            musicLineItem.append(playButtonCol)

            let addToPlaylistButton = document.createElement('img')
            addToPlaylistButton.src = 'app/img/add-to-playlist-button.svg'
            addToPlaylistButton.classList.add('generic-btn')
            addToPlaylistCol.append(addToPlaylistButton)
            musicLineItem.append(addToPlaylistCol)

            let musicTitle = document.createElement('h3')
            musicTitle.innerHTML = i.name
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
            duration.innerHTML = i.duration
            durationCol.append(duration)
            musicLineItem.append(durationCol)

            let release = document.createElement('h3')
            release.innerHTML = i.realease
            releaseCol.append(release)
            musicLineItem.append(releaseCol)

        })
    })
}
listLibrary( )

const listPlaylists = ( ) => {
    fetch('app/data/playlist.json')
    .then(response => response.json())
    .then(data => {
        data.forEach(i => {
            let playlists = document.getElementById('playlists')

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

const playMusic = (id) => {
    // e.preventDefault()

    let audioPlayer = document.getElementById('audio-player')

    let $playButton = document.getElementById('play-button')
    let $pauseButton = document.getElementById('pause-button')

    document.addEventListener('onclick', playMusic( ))

    id = 'nada'

    console.log(id)
}

let switchButton = ( ) => {
    console.log('switchButton')
}
switchButton( )

/*

    playPlaylist(id) {

    }
    validateUrl(input) {
        Validar input e só chamar o script caso esteja correto.
    }
    searchMusic( ) {
        Request AJAX.
        Verificar se é possível em um JSON local.
    }
    playlistStream(generic) {
        Ao invés de reproduzir a faixa escolhida diretamente, enviar a faixa para uma playlist genérica (que será apagada e reescrita sempre que o usuário der um novo play) e com isso, entra uma nova opção de add a fila, que é um objeto apenas na memória.
    }
    addToRow(id) {
        Enfilera música desejada na genericPlaylist.
    }

*/
