<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH | Gallery</title>
    <link rel="stylesheet" href="assets/css/gallery.css">
    <link rel="shortcut icon" href="assets/img/favIcon2.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    <link rel="stylesheet" href="gallery.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <div id="container">
        <?php
        if (!is_null($images)) {
            foreach ($images as $value) :
                $caption = "<p class='caption'><span> name:</span>$value[name] <br> <span>Size:</span>$value[size] Byte<br> <span>Format:</span>$value[type] <br> <span>created at:</span>$value[createdAt]</p>";
        ?>
                <div class="element">
                    <a href="<?= $value['path'] ?>" class="fancybox" data-fancybox="gallery" data-caption="<?= $caption; ?>">
                        <img src="<?= $value['path']; ?>" class="fancybox" alt="Image : <?= $value['name'] ?>">
                    </a>
                    <span class="deleteImage clickable" data-deleteImageId="<?= $value['id']; ?>" onclick="return confirm('Are You Sure?')">Delete</span>
                </div>
            <?php
            endforeach;
        } else {
            ?>
            <div class="aler">There Is Not Any Image<br> Please <a href="<?= siteUrl() ?>">Clikc Here</a></div>
        <?php } ?>

    </div>

    <script>
        $(document).ready(function() {
            $(".deleteImage").click(function() {
                var imageId = $(this).attr("data-deleteImageId");
                $.ajax({
                    url: "process/ajaxHandler.php",
                    method: "post",
                    data: {
                        action: "deleteImage",
                        imageId: imageId
                    }
                });
            });
        });
    </script>

</body>

</html>