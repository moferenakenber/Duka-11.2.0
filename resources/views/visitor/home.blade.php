<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Gallery</title>
</head>
<body>
    <h1>Video Gallery</h1>

    <video controls width="600">
        <source src="{{ asset('videos/Cars%20(2006)/Cars.2006.720p.BrRip.x264.YIFY.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <video controls width="600">
        <source src="{{ asset('videos/Cosmos.A.SpaceTime.Odyssey.S01.1080p.BluRay.x265-RARBG/Cosmos.A.SpaceTime.Odyssey.S01E04.1080p.BluRay.x265-RARBG.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Add more videos here -->

</body>
</html>
