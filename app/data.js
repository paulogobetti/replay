let musicData = [
    {
        track_id: 1,
        name: 'Hello World',
        artist: 'Hackerson',
        album: 'Hello World',
        realease: 2008,
        src: 'app/media/Hackerson - Hello World [Hello World - 2008].mp3',
        thumbnail: 'app/media/Hackerson - Hello World [Hello World - 2008].jpg'
    },
    {
        track_id: 22,
        name: 'A Horse With Name',
        artist: 'Asia',
        album: 'Good Bye',
        realease: 2015,
        src: 'app/media/Asia - A Horse With Name [Good Bye - 2015].mp3',
        thumbnail: 'app/media/Asia - A Horse With Name [Good Bye - 2015].jpg'
    }
]
console.log(JSON.stringify(musicData, '/t', 2))

let playlists = [
    {
        playlist_id: 1,
        playlist_name: "Post Punk",
        tracks: [1]
    },
    {
        playlist_id: 9,
        playlist_name: "Dream Pop",
        tracks: [22, 1]
    },
    {
        playlist_id: 56,
        playlist_name: "Pop Rock",
        tracks: [22]
    }
]
console.log(JSON.stringify(playlists, '/t', 2))
