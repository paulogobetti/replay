const httpRequest = (url) => {
    // document.getElementById('content').innerHTML = ''

    // if(!document.getElementById('loading')) {
    //     let imgLoading = document.createElement('img')
    //     imgLoading.src = 'app/img/loading.gif'
    //     imgLoading.id = 'loading'

    //     document.getElementById('content').appendChild(imgLoading)
    // }

    let ajax = new XMLHttpRequest()

    ajax.open('GET', url)
    ajax.onreadystatechange = ( ) => {
        if(ajax.readyState === 4 && ajax.status == 200) {
            let playlistName = document.getElementById('playlist-name').value
            if(url == '../../src/new-playlist.php?new=' + playlistName) {
                return
            }

            document.getElementById('content').innerHTML = ajax.responseText

            if(url == 'app/components/library.php') {
                listLibrary()
            }
        }
        if(ajax.readyState === 4 && ajax.status == 404) {
            alert('Error: ' + ajax.status)

            return
        }
    }

    ajax.send()
}
