<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



require_once 'functions/functions.php';
require_once 'config.php';

if(ifFormSubmitted()){
    $fileName = basename($_FILES["file"]["name"]);
    $target_file = UPLOADS_DIR . $fileName;

    if(isFileValid($target_file, IMAGE_EXTENSIONS)){
        $isFileUploaded = move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        $data = createDataFromFile($target_file, STRING_SEPARATOR);
    }
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1 class="mb-5">Hello!</h1>
    <form action="/" method="POST" class="mb-4  " enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formFile" class="form-label">Загрузите файл</label>
            <input class="form-control" name="file" type="file" id="formFile" accept=".txt" placeholder="<?= $fileName?? 'Файл не выбран' ?>">
        </div>
        <?php
            if(isset($isFileUploaded)){
                $color = 'red';
                if($isFileUploaded){
                    $color = 'green';
                }
        ?>
        <p class="">
            <span class="h4"><?= $fileName ?></span> - <i class="bi bi-brightness-high-fill" style="font-size: 32px; color: <?= $color ?>;"></i>
        </p>
        <?php } ?>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
    <div>
    <?php
        if(isset($data)) {
            ?>
            <h2>Результат обработки файла</h2>
        <?php
            foreach ($data as $item) {
                ?>
                <p><strong><?= $item['string']?></strong> = <?= $item['numbers']?></p>
            <?php
            }
        }
    ?>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>