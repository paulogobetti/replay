<?php

    // Inicialmente o shell_exec() precisa das bibliotecas instaladas no escopo global do sistema; estudando uma maneira de utilizar tanto o youtube-dl quanto as libs de conversão localmente, como um software 'portable'.
    // Problemas: permissão => alguns comandos de libs do sistema (para conversão e edição do arquivo) só funcionam com elevação de privilégio; defasagem => o Google sempre quebra o youtube-dl, tornando necessário atualizações constantes, então, precisaria adaptar isso para funcionar localmente e ter o próprio script de atualização como usuário, sem a necessidade do sudo.
    // Algo como shell_exec(rm -rf /includes/youtube-dl, git clone, unzip).
    // Caso não exista mesmo uma maneira de utilizar localmente, talvez adicionar o www-data no sudoers. // Acredito ser um problema.

    $url = $_POST['url'];
    $command = "/usr/local/bin/youtube-dl -x --audio-format mp3 --audio-quality 320K --embed-thumbnail -o '/home/${USER}/media/%(channel)s - %(title)s [%(album)s - %(release_year)s].%(ext)s' " . $url . " 2>&1";
    // --no-check-certificate -x... // Ignorar checagem caso o script não rode.
    // Não é uma boa ideia ignorar a checagem poréeeeem...
    echo "<pre>$command</pre>";

    $getFile = shell_exec($command);
    echo "<pre>$getFile</pre>";
