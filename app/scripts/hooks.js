const downloadAudioHook = (ytUrl) => {
    httpRequest('../../src/download-audio.php?url=' + ytUrl)
}

const newPlaylistHook = (playlistName) => {
    httpRequest('../../src/new-playlist.php?new=' + playlistName)
}

const addToPlaylistHook = (music, playlistID) => {
    httpRequest('../../src/add-to-playlist.php?music=' + music + '&playlist=' + playlistID)
}
