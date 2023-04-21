let musicData = [
    {
        track_id: 1,
        name: 'Hello World',
        artist: 'Hackerson',
        album: 'Hello World',
        realease: 2008,
        src: 'media/Hackerson - Hello World [Hello World - 2008].mp3',
        thumbnail: 'media/img/Hackerson - Hello World [Hello World - 2008].jpg'
    },
    {
        track_id: 22,
        name: 'A Horse With Name',
        artist: 'Asia',
        album: 'Good Bye',
        realease: 2015,
        src: 'media/Asia - A Horse With Name [Good Bye - 2015].mp3',
        thumbnail: 'media/img/Asia - A Horse With Name [Good Bye - 2015].png'
    }
]
console.log(musicData)

let playlists = {
    "Post Punk": {
        "playlist_id": 1,
        "tracks_id": [1]
    },
    "Dream Pop": {
        "playlist_id": 9,
        "tracks_id": [22, 1]
    },
    "Pop Rock": {
        "playlist_id": 56,
        "tracks_id": [22]
    }
}
console.log(playlists)
