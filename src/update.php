<?php

    $youtubeDlUrl = 'https://yt-dl.org/downloads/latest/youtube-dl';
    $ffmpegUrl = 'https://johnvansickle.com/ffmpeg/releases/ffmpeg-release-amd64-static.tar.xz';

    $command = 'mkdir includes && curl -L ' . $youtubeDlUrl . ' --output ./includes/youtube-dl && curl ' . $ffmpegUrl . ' --output ./includes/ffmpeg && tar -Jxf ./includes/ffmpeg -C ./includes/ && rm -rf ./includes/ffmpeg && chmod +x -R ./includes';

    $output = exec($command);

    var_dump($output);
