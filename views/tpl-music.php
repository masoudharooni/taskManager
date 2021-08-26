<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/music.css" />
    <title>MH TODO | musicPlayer</title>
    <link rel="shortcut icon" href="assets/img/favIcon2.png" type="image/x-icon">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <style>
        body {
            min-height: 200vh;
            background: linear-gradient(to top right, #060628, #1F245A, #682359);
        }

        #wrapper {
            margin: auto;
            max-width: 700px;
        }
    </style>
</head>

<body>

    <div id="wrapper">

        <?php
        if (!is_null($musicData)) {
            foreach ($musicData as $value) : ?>
                <div class="musicContent">
                    <p class="sogner"><?= $value['name'] ?></p>
                    <audio class="audio" preload="auto" controls>
                        <source src="<?= $value['path'] ?>">
                    </audio>
                </div>
                <div class="deleteMusic" data-musicId="<?= $value['id'] ?>" data-path="<?= $value['path'] ?>">Delete This Music</div>
                <hr>
            <?php endforeach;
        } else { ?>
            <div class="musicEmpty">There isn't any music <br> <a href="<?= siteUrl() ?>">Add Music</a></div>
        <?php } ?>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="assets/js/AudioPlayer.js"></script>
        <script>
            $(function() {
                $('audio').audioPlayer();
            });
        </script>
    </div>

</body>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>

</html>