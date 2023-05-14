<?php

/*

    getAppCore( ) {
        Baixa as dependências.

        ... ffmpeg bin src
        ... https://johnvansickle.com/ffmpeg/releases/ffmpeg-release-amd64-static.tar.xz

        ... youtube-dl src
        ... sudo wget https://yt-dl.org/downloads/latest/youtube-dl -O /usr/local/bin/youtube-dl
        ... sudo chmod a+rx /usr/local/bin/youtube-dl

        Atribui ao usuário do apache (daemon ou www-data) o novo download.
    }
    coreUpgrade( ) {
        Verifica se existe versões novas das dependências.

        Copia "core antigo" e envia para diretório .old.

        getAppCore( )

        Se der certo, remover .old else {deletar atuais e copiar .old novamente}
    }
    appUpgrade( ) {
        Verifica se existe versões novas do app.

        // git clone ...replay
    }

*/
