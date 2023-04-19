<?php

    $url = $_POST['url'];
    $command = "/usr/local/bin/youtube-dl -x --audio-format mp3 --audio-quality 320K --embed-thumbnail -o '/home/paulo/media/%(channel)s - %(title)s [%(album)s - %(release_year)s].%(ext)s' " . $url . " 2>&1";
    // --no-check-certificate -x...
    // Não é uma boa ideia ignorar a checagem poréeeeem...
    echo "<pre>$command</pre>";

    $getFile = shell_exec($command);
    echo "<pre>$getFile</pre>";
