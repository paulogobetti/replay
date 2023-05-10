const listLibrary = ( ) => {
    fetch('app/data/library.json')
    .then(response => response.json())
    .then(data => {
        data.forEach(i => {
            // Retornar paginado... while?
            let library = document.getElementById('content-display')
            let coverUrl = i.thumbnail

            let playButton = document.createElement('img')
            playButton.src = 'app/img/play-list-button.svg'
            playButton.classList.add('generic-btn')

            let addToPlaylistButton = document.createElement('img')
            addToPlaylistButton.src = 'app/img/add-to-playlist-button.svg'
            addToPlaylistButton.classList.add('generic-btn')

            let musicTitle = document.createElement('h3')
            musicTitle.innerHTML = i.name

            let artist = document.createElement('h3')
            artist.innerHTML = i.artist

            let album = document.createElement('h3')
            album.innerHTML = i.album

            let duration = document.createElement('h3')
            duration.innerHTML = '00:00'

            let release = document.createElement('h3')
            release.innerHTML = i.realease

            let musicItem = document.createElement('div')
            musicItem.classList.add('music-card')

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
            library.append(musicItem)
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

/*

    playMusic(id) {

    }
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
