<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloader</title>
    <!-- FAVICON -->
    <link rel="icon" type="image/x-icon" href="img/replay-logo-favicon.svg">

</head>
<body>
    <form action="../src/update.php" method="POST">
        <input type="submit" value="Download/Update Dependencies">
    </form>
    <form action="../src/audio-download.php" method="POST">
        <input type="text" name="url" id="">
        <input type="submit" value="Download Music">
    </form>
</body>
</html>
