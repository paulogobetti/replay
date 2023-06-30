<?php

    const YOUTUBE_DL_URL = 'https://yt-dl.org/downloads/latest/youtube-dl';
    const FFMPEG_URL = 'https://johnvansickle.com/ffmpeg/releases/ffmpeg-release-amd64-static.tar.xz';

    $command = 'mkdir includes && curl -L ' . YOUTUBE_DL_URL . ' --output ./includes/youtube-dl && curl ' . FFMPEG_URL . ' --output ./includes/ffmpeg && tar -Jxf ./includes/ffmpeg -C ./includes/ && rm -rf ./includes/ffmpeg && chmod +x -R ./includes';

    exec($command);

    // var_dump($output);
